<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SchoolReportsGradesEditableGrid extends Component
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var object
     */
    public ?object $grades;

    /**
     * @var array
     */
    public ?array $subjects;

    /**
     * @var bool
     */
    public ?bool $readonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $grades = null, $subjects = [], $readonly = false)
    {
        $this->id = $id;
        $this->grades = $grades;
        $this->subjects = $subjects;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.school-reports-grades-editable-grid');
    }
}
