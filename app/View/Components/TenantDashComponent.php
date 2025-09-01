<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TenantDashComponent extends Component
{
    public array $dashboardData;

    /**
     * Create a new component instance.
     */
    public function __construct(array $dashboardData = [])
    {
        $this->dashboardData = $dashboardData;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tenant-dash-component', [
            'dashboardData' => $this->dashboardData
        ]);
    }
}
