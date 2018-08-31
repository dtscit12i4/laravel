<?php

namespace App\Http\Services;

use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Builder;

class ExtendSoftDeletingScope extends SoftDeletingScope
{
	public function extend(Builder $builder)
    {
        foreach ($this->extensions as $extension) {
            $this->{"add{$extension}"}($builder);
        }

        $builder->onDelete(function (Builder $builder) {
            $column = $this->getDeletedAtColumn($builder);
            $column_by = $this->getDeletedAtByColumn($builder);

            return $builder->update([
                $column => $builder->getModel()->freshTimestampString(),
                // $column_by => Auth::user()->id,
                $column_by => '3',
            ]);
        });
    }

    protected function getDeletedAtByColumn(Builder $builder)
    {
        if (count((array) $builder->getQuery()->joins) > 0) {
            return $builder->getModel()->getQualifiedDeletedAtByColumn();
        }

        return $builder->getModel()->getDeletedAtByColumn();
    }
}