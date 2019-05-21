<?php
namespace onbuy\model\repositories;

use onbuy\model\Repository;
use onbuy\model\entities\Feedback;

class FeedbackRepository extends Repository {
    public function getTableName() {
        return 'feedback';
    }
    public function getEntityClass() {
        return Feedback::class;
    }
}
