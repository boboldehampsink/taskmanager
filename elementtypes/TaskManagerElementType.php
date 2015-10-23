<?php

namespace Craft;

/**
 * Task Manager.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, Bob Olde Hampsink
 * @license   MIT
 *
 * @link      http://github.com/boboldehampsink
 */
class TaskManagerElementType extends BaseElementType
{
    /**
     * Returns the element type name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Task Manager');
    }

    /**
     * Returns whether this element type has content.
     *
     * @return bool
     */
    public function hasContent()
    {
        return false;
    }

    /**
     * Returns whether this element type has titles.
     *
     * @return bool
     */
    public function hasTitles()
    {
        return false;
    }

    /**
     * Returns whether this element type has statuses.
     *
     * @return bool
     */
    public function hasStatuses()
    {
        return true;
    }

    /**
     * Returns this element's statuses.
     *
     * @return array
     */
    public function getStatuses()
    {
        return array(
            EntryModel::PENDING => Craft::t('Pending'),
            EntryModel::EXPIRED => Craft::t('Error'),
            EntryModel::LIVE    => Craft::t('Running'),
        );
    }

    /**
     * Return sources.
     *
     * @param string $context
     *
     * @return array
     */
    public function getSources($context = null)
    {
        $sources = array(
            '*' => array(
                'label'    => Craft::t('All tasks'),
                'criteria' => array(),
            ),
        );

        // Allow plugins to modify the sources
        craft()->plugins->call('modifyTaskManagerSources', array(&$sources, $context));

        return $sources;
    }

    /**
     * Returns the attributes that can be shown/sorted by in table views.
     *
     * @param string|null $source
     *
     * @return array
     */
    public function defineTableAttributes($source = null)
    {
        $attributes = array(
            'description' => Craft::t('Description'),
            'dateCreated' => Craft::t('Created'),
            'currentStep' => Craft::t('Current step'),
            'totalSteps'  => Craft::t('Total steps'),
            'actions'     => '',
        );

        // Allow plugins to modify the attributes
        craft()->plugins->call('modifyTaskManagerTableAttributes', array(&$attributes, $source));

        return $attributes;
    }

    /**
     * Get table attribute html.
     *
     * @param BaseElementModel $element
     * @param string           $attribute
     *
     * @return string
     */
    public function getTableAttributeHtml(BaseElementModel $element, $attribute)
    {
        // First give plugins a chance to set this
        $pluginAttributeHtml = craft()->plugins->callFirst('getTaskManagerTableAttributeHtml', array($element, $attribute), true);

        if ($pluginAttributeHtml !== null) {
            return $pluginAttributeHtml;
        }

        // Show special actions
        if ($attribute == 'actions') {
            return '<a href="javascript:void(0)" class="restart icon" title="'.Craft::t('Restart').'"> '
                    .'<a href="javascript:void(0)" class="delete icon" title="'.Craft::t('Delete').'"></a>';
        }

        // Or format default
        return parent::getTableAttributeHtml($element, $attribute);
    }

    /**
     * Define sortable attributes.
     *
     * @param string $source
     *
     * @return array
     */
    public function defineSortableAttributes($source = null)
    {
        $attributes = array(
            'dateCreated' => Craft::t('Created'),
        );

        // Allow plugins to modify the attributes
        craft()->plugins->call('modifyTaskManagerSortableAttributes', array(&$attributes));

        return $attributes;
    }

    /**
     * Modifies an element query targeting elements of this type.
     *
     * @param DbCommand            $query
     * @param ElementCriteriaModel $criteria
     *
     * @return mixed
     */
    public function modifyElementsQuery(DbCommand $query, ElementCriteriaModel $criteria)
    {
        // Default query
        $query
            ->select('tasks.id, tasks.currentStep, tasks.totalSteps, tasks.status, tasks.type, tasks.description, tasks.dateCreated')
            ->from('tasks tasks');

        // Reset default element type query parts
        $query->setJoin('');
        $query->setWhere('1=1');
        $query->setGroup('');
        unset($query->params[':locale']);
        unset($query->params[':elementsid1']);

        // Add search capabilities
        if ($criteria->search) {
            $query->andWhere(DbHelper::parseParam('description', '*'.$criteria->search.'*', $query->params));
            $criteria->search = null;
        }
    }

    /**
     * Populates an element model based on a query result.
     *
     * @param array $row
     *
     * @return array
     */
    public function populateElementModel($row)
    {
        return TaskManagerModel::populateModel($row);
    }
}
