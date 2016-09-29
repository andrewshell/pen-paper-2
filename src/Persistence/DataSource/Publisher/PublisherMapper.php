<?php
namespace PenPaper\Persistence\DataSource\Publisher;

use Atlas\Orm\Mapper\AbstractMapper;

/**
 * @inheritdoc
 */
class PublisherMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        // no related fields
    }
}
