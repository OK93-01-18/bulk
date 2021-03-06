<?php

declare(strict_types=1);

namespace PDOBulk\Db;

class PSLInsNth extends BulkDB
{

    protected function getQuery(int $numRecords) : string
    {

	$ifields = implode(', ', $this->ifields);
	$rfields = implode(', ', $this->rfields);

	$ivalues = implode(', ', array_fill(0, $this->inumFields, '?'));

	$query  = 'INSERT INTO ' . $this->table . ' (' . $ifields . ') VALUES (' . $ivalues . ')';

	$endquery = ' ON CONFLICT DO NOTHING';

	if (!empty($rfields)) {
	    $endquery .= ' RETURNING ' . $rfields;
	}

	$query .= str_repeat(', (' . $ivalues . ')', $numRecords - 1);
	$query = ''. $query . '' . $endquery . '';

	return $query;

    }

}
