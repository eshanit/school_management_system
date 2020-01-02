<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkSchedule extends Model
{
    //
     //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', 
        'studentclass_id',
        'teacher_id',
        'subject_id',
        'year',
        'term_id',
        'exam_date',
        'maxmarks_paper_1',
        'maxmarks_paper_2',
        'maxmarks_paper_3',
        'maxmarks_paper_4',
        'marks_paper_1',
        'marks_paper_2',
        'marks_paper_3',
        'marks_paper_4',
        'updated_at',
        'created_at',
        'updated_at',
    ];
}
