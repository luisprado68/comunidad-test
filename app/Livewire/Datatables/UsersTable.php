<?php

namespace App\Http\Livewire\Datatables;

use App\Enums\WebhookActions;
use App\Models\Branch;
use App\Models\Deal;
use App\Models\User;
use App\Models\Webhook;
use App\Services\BranchService;
use App\Services\UserService;
use App\Services\WebhookService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\WithPagination;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

use Illuminate\Support\Facades\Log;

class BranchesTable extends DataTableComponent
{
    use WithPagination;


    public $dateFilter;
    public $order = 0;
    protected $model = User::class;
    protected $listeners = [
        'refreshTable' => '$refresh',
        'refreshPaginate',
    ];
    public $section = 'branches';

    private $publicationService;
    private $marketplaceService;
    private $userService;


    public function mount()
    {
        $userService = new UserService();
        $this->userService = $userService;

    }


    public function builder(): Builder
    {
        $userService = new UserService();
        $this->userService = $userService;
        $query = $this->userService->TableQuery(session('statusTabFilter'), session('branchesFilter'));
        return $query;
    }

    public function refreshPaginate()
    {
        $this->resetPage();
        $this->order = 0;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPaginationEnabled();
        $this->setPerPageAccepted([5, 10, 25, 50, 100]);
        $this->setPerPage(10);
        $this->setEmptyMessage(trans('datatables.no-results'));
        $this->setColumnSelectDisabled();
        $this->setSearchDisabled();
        $this->setSearchVisibilityDisabled();
    }

public function columns(): array
{
return [
    Column::make('Id', 'id')
    ->hideIf(true)
    ,
    //Column::make(trans('DDBB order'), 'order'),

    // Column::make(trans('branch.datatable.order'), 'channel')
    //    ->format(function ($value) {
    //        $total = $this->branchesService->getTotal();
    //        return $total-$value+1;
    //    })->html()
    // ,

    Column::make(trans('branch.datatable.title'), 'channel')
       ,
    // Column::make(trans('branch.datatable.phone'), 'phone')
    // ,
    // Column::make(trans('branch.datatable.open-hours'), 'open_hours')
    //     ->format(function ($value, $row) {
    //        $open_hours = json_decode($value);
    //         $dates = null;
    //         if($open_hours){
    //             foreach ($open_hours->days as $day){
    //                 $firsTurn = $day->firstTurn->open." a ".$day->firstTurn->close;
    //                 if( $firsTurn == "0 a 0"){
    //                     $firsTurn = "-";
    //                 }
    //                 $secondTurn = $day->secondTurn->open?$day->secondTurn->open." a ".$day->secondTurn->close:null;
    //                 $dates .= "<li>
    //                         <div class='row'>
    //                             <span class='py-0 col-2'>".
    //                     trans("branch.datatable.days.".$day->day)
    //                     ."</span>
    //                              <span class='py-0 col-10'>".
    //                     $firsTurn.($secondTurn?" - ".$secondTurn:"")
    //                     ."</span>
    //                     </div></li>"
    //                 ;
    //             }
    //         }
    //        return $open_hours?"<ul style='list-style: none; padding-left: 0'>".$dates."</ul>":null;

    //     })->html(),
    // Column::make('city', 'city')
    //     ->hideIf(true)
    // ,
    // Column::make('state', 'state')
    //     ->hideIf(true)
    // ,
    // Column::make(trans('branch.datatable.adress'), 'street')
    //     ->format(function ($value, $row) {
    //         $city = $row->city??null;
    //         $state = $row->state != $city?$row->state:null;
    //         return "<p class='text-start'>
    //                     <strong>".$value."</strong>
    //                     </br>
    //                     <span class='text-muted' style='white-space: nowrap'>$city</span>
    //                     </br>
    //                     <span class='text-muted' style='white-space: nowrap'>$state</span>
    //                 </p>";

    //     })->html(),

    // Column::make(trans('branch.datatable.email'), 'email')
    //     ->hideIf(true)
    // ,
    // Column::make(trans('branch.datatable.status'), 'is_disabled')
    //     ->format(function ($value, $row) {
    //         //dump($value);
    //         $status = $row->formatStatus();
    //         return "<strong>
    //                     <span class='gap-2 d-flex text-" . $status["color"] . "'> <i class='" . $status["icon"] . "'></i>" . $status["text"] . "</span>
    //                 </strong>";
    //     })
    //     ->html(),
    // Column::make( '')
    //     ->label(function ($row ) {
    //         $itemOptions = $row->getItemOptions();
    //         //dump($itemOptions[1]['is_disabled']);
    //         return view('livewire.datatables.detail-button')->withItemId($row->id)->withSection($this->section)->withItemOptions($itemOptions);
    //     }),

];

}

}
