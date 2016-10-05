<?php
namespace PenPaper\Persistence\DataSource\MagazineIssueCreator;

use Atlas\Orm\Mapper\AbstractMapper;
use PenPaper\Persistence\DataSource\Creator\CreatorMapper;
use PenPaper\Persistence\DataSource\MagazineIssue\MagazineIssueMapper;
use PenPaper\Persistence\DataSource\Credit\CreditMapper;
/**
 * @inheritdoc
 */
class MagazineIssueCreatorMapper extends AbstractMapper
{
    /**
     * @inheritdoc
     */
    protected function setRelated()
    {
        $this->manyToOne('creator', CreatorMapper::class);
        $this->manyToOne('magazine_issue', MagazineIssueMapper::class);
        $this->manyToOne('credit', CreditMapper::class);
    }
}
