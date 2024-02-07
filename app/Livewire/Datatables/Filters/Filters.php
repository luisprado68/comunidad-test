<?php

namespace App\Http\Livewire\Datatables\Filters;

use App\Enums\ReviewCheckedStatus;
use App\Models\PaymentMethod;
use App\Models\Pod;
use App\Services\AccountMarketplaceService;
use App\Services\AccountMarketplaceSettingService;
use App\Services\BillingService;
use App\Services\BranchService;
use App\Services\CustomerService;
use App\Services\OrderHistoryService;
use App\Services\PaymentMethodService;
use App\Services\PodService;
use App\Services\PublicationService;
use App\Services\ShipmentMethodService;
use App\Services\Woocommerce\WooOrderService;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Filters extends Component
{

    private $service;
    public $section;

    public $view;
    public $filter = null;
    public $displayFilters;
    public $accountUserRole;
    public $table;
    public $marketplaces;
    public $checkedStatus;
    public $chekedStatusValue = [];
    public $orderHistorys;
    public $customerDates;
    public $currentAccountId;
    private $paymentMethodService;
    public $detailFilterComponents;
    public $detailFilterConfig;


    //amount filter
    public $displayAmount;
    public $minAmount = 0;
    public $maxAmount = 0;
    public $amountLabel;
    public $amountError;

    //marketplace filter
    public $displayMarketplaces;
    public $marketplaceLabel;
    public $selectedMarketplaces = [];

    //date filters
    public $displayDate;
    public $startDate = null;
    public $endDate = null;
    public $today;
    public $dateLabel;
    public $compareDates;
    public $compareStartDate = null;
    public $compareEndDate = null;
    public $compareDateLabel;
    public $checkedStatusLabel;
    public $selectedCheckedStatus;
    public $displayCheckedStatus;
    //search filter
    public $searchString = null;
    public $showSearchResults;

    //report status filter
    public $filterTabs;
    public $filterStatus;
    public $displayStatus;
    public $statusLabel;
    public $selectedStatus = [];

    //billing
    public $billingLabel;
    public $displayBilling;
    public $selectedBillingStatus;

    //orderBy
    public $orderByOptions;
    public $orderColumn;
    public $orderDirection;

    //pod Count
    public $filterPodCount;
    public $displayPodCount;
    public $podCountLabel;
    public $selectedPodCount = [];

    //billing payment method
    public $filterPaymentMethods;
    public $displayPaymentMethods;
    public $paymentMethodLabel;
    public $selectedPaymentMethods = [];
    public $mappedPaymentMethods = [];

    //shipping methods
    public $filterShipmentMethods;
    public $displayShipmentMethods;
    public $shipmentMethodsLabel;
    public $selectedShipmentMethods;
    public $mappedShipmentMethods = [];

    //branches statse
    public $filterBranchStates;
    public $displayBranchStates;
    public $BranchStatesLabel;
    public $selectedBranchStates = [];
    public $exporting;

    public $filterOrderHistoryStates;
    public $displayOrderHistoryStates;
    public $OrderHistoryStatesLabel;
    public $selectedOrderHistoryStates = [];

    //currencyFilters
    public $currencyLabel;
    public $selectedCurrency;
    public $displayCurrencyStatus;

    public $selectedOption;

    protected $listeners = ['FilterTabChanged', 'exportFinished'];

    public function booted()
    {
        $this->today = date("Y-m-d");
    }

    public function mount()
    {
        $this->displayFilters = false;
        $this->displayAmount = false;
        $this->resetSelectedFilters("all");
        $this->resetFilters();

    }

    public function render()
    {
        $this->currentAccountId = session('currentAccountId');

        if ((Session::has('exportingFile')) && session('exportingFile')) {
            $this->exporting = true;
        }
        $this->populateFilters();

        return view('livewire.datatables.filters.filters');
    }

    /**
     * Reset filters on tab state selection
     */
    public function FilterTabChanged($section)
    {
        $this->hideFilters("all");
        $this->resetSelectedFilters("all");
        $this->resetFilters();
        $this->applyFilters();
    }

    

    public function populateFilters()
    {
        // Log::debug('detailFilterComponents-------------' .json_encode($this->detailFilterComponents));
        foreach ($this->detailFilterComponents as $filter) {
            if ($filter == 'pod-count-filter') {
                $podService = new PodService();
                $this->filterPodCount = $podService->getPodQuantities();
            }
            if ($filter == 'branch-state-filter') {
                $branchService = new BranchService();
                $this->filterBranchStates = $branchService->getBranchesStates();
            }
            if ($filter == 'marketplace-filter') {
                $accountMarketplaceService = new AccountMarketplaceService();
                $this->marketplaces = $accountMarketplaceService->getAllByAccountId($this->currentAccountId);
            }
            if ($filter == 'checked-status-filter') {
                // $accountMarketplaceService = new AccountMarketplaceService();
                $this->checkedStatus = ReviewCheckedStatus::getKeys();
            }
            if ($filter == 'history-filter') {
                $orderHistoryService = new OrderHistoryService();
                $this->orderHistorys = $orderHistoryService->getordersHistoriesByOrderId(session('orderId'));
            }
            if ($filter == 'customer-date-filter') {
                $customerService = new CustomerService();
                $this->customerDates = $customerService->all();
            }
        }
    }

    /**
     * Hide or display and reset all filters components
     */
    public function toggleAllFilter()
    {

        $this->hideFilters("all");
        if ($this->view === "report") {
            $this->resetSelectedFilters("displayAmount");
            $this->resetSelectedFilters("displayMarketplaces");
            $this->resetSelectedFilters("displayStatus");
            $this->resetSelectedFilters("displayCheckedStatus");
        } else {
            $this->resetSelectedFilters("all");
        }
        $this->displayFilters = !$this->displayFilters;
        //$this->resetFilters();
    }

    /**
     * Hide or display individual filter dropdown
     */
    public function toggleFilters($var)
    {
        $this->hideFilters($var);
        $this->$var = !$this->$var;
    }

    /**
     * Hide all filters selection dropdown
     */
    public function hideFilters($var)
    {
        $var != "displayAmount" ? $this->displayAmount = false : null;
        $var != "displayMarketplaces" ? $this->displayMarketplaces = false : null;
        $var != "displayStatus" ? $this->displayStatus = false : null;
        $var != "displayCheckedStatus" ? $this->displayCheckedStatus = false : null;
        $var != "displayBilling" ? $this->displayBilling = false : null;
        $var != "displayDate" ? $this->displayDate = false : null;
        $var != "showSearchResults" ? $this->showSearchResults = false : null;
        $var != "displayPodCount" ? $this->displayPodCount = false : null;
        $var != "displayBranchStates" ? $this->displayBranchStates = false : null;
        $var != "displayCurrencyStatus" ? $this->displayCurrencyStatus = false : null;
    }

    /**
     * Reset filter
     * param filteName
     */

    public function resetSelectedFilters($var)
    {


        switch ($var) {
            case "displayAmount":
                $this->maxAmount = 0;
                $this->minAmount = 0;
                $this->amountLabel = null;
                $this->amountError = false;
                $this->displayAmount = false;
                break;
            case "displayMarketplaces":
                $this->marketplaceLabel = null;
                $this->selectedMarketplaces = [];
                $this->displayMarketplaces = false;
                break;
            case "displayStatus":
                $this->statusLabel = null;
                $this->selectedStatus = [];
                $this->displayStatus = false;
                break;
            case "displayCheckedStatus":
                $this->checkedStatusLabel = null;
                $this->selectedCheckedStatus = [];
                $this->displayCheckedStatus = false;
                break;
            case "displayBilling":
                $this->billingLabel = null;
                $this->selectedBillingStatus = null;
                $this->displayBilling = false;
                break;
            case "displayDate";
                $this->startDate = null;
                $this->endDate = null;
                $this->dateLabel = null;
                $this->displayDate = false;
                $this->compareStartDate = null;
                $this->compareEndDate = null;
                $this->compareDateLabel = null;
                $this->displayDate = false;
                break;
            case "all";
                $this->startDate = null;
                $this->endDate = null;
                $this->dateLabel = null;
                $this->displayDate = false;
                $this->compareStartDate = null;
                $this->compareEndDate = null;
                $this->compareDateLabel = null;
                $this->maxAmount = 0;
                $this->minAmount = 0;
                $this->amountLabel = null;
                $this->amountError = false;
                $this->displayAmount = false;
                $this->marketplaceLabel = null;
                $this->checkedStatusLabel = null;
                $this->checkedStatus = null;
                $this->chekedStatusValue = null;
                $this->displayCheckedStatus = false;
                $this->selectedCheckedStatus = [];
                $this->selectedMarketplaces = [];
                $this->displayMarketplaces = false;
                $this->statusLabel = null;
                $this->selectedStatus = [];
                $this->displayStatus = false;
                $this->orderDirection = null;
                $this->orderColumn = null;
                $this->billingLabel = null;
                $this->selectedBillingStatus = null;
                $this->displayBilling = false;
                $this->displayPodCount = false;
                $this->podCountLabel = null;
                $this->selectedPodCount = [];
                $this->displayPaymentMethods = false;
                $this->paymentMethodLabel = null;
                $this->selectedPaymentMethods = [];
                $this->mappedPaymentMethods = [];
                $this->displayShipmentMethods = false;
                $this->shipmentMethodsLabel = null;
                $this->selectedShipmentMethods = [];
                $this->mappedShipmentMethods = [];
                $this->displayBranchStates = false;
                $this->BranchStatesLabel = null;
                $this->selectedBranchStates = [];
                break;
        }

        if ($var === "displayCompareDate") {
            $this->compareStartDate = null;
            $this->compareEndDate = null;
            $this->compareDateLabel = null;
            $this->emit('resetCompareStatistics');
        } else {
            if ($this->displayFilters) {
                $this->applyFilters();
            }
        }
    }

    /**
     * Sets data selection logic
     */
    public function manageDateSelection()
    {
        if ($this->startDate && !$this->endDate) {
            $this->endDate = $this->startDate;
        }
        $this->manageCompareDateSelection();
    }

    public function manageCompareDateSelection()
    {
        $date1 = new DateTime($this->startDate);
        $date2 = new DateTime($this->endDate);
        $days  = $date2->diff($date1)->format('%a');

        if ($this->compareStartDate) {
            $date = new DateTime($this->compareStartDate);
            $date->add(new DateInterval('P' . $days . 'D'));
            $this->compareEndDate = $date->format('Y-m-d');
        }
    }

    /**
     * Set amount filter logic
     */
    public function setAmount()
    {
        if ($this->minAmount > $this->maxAmount && $this->maxAmount != 0) {
            $this->amountError = true;
        } else {
            $this->amountError = false;
            $this->displayAmount = false;
            if ($this->minAmount && $this->maxAmount != 0) {
                $this->amountLabel = "$" . number_format($this->minAmount, 0, ",", ".") . " a $" . number_format($this->maxAmount, 0, ",", ".");
            }
            if ($this->minAmount && $this->maxAmount == 0) {
                $this->amountLabel = trans("datatables.filters.detailedFilters.amount.from") . " $" . number_format($this->minAmount, 0, ",", ".");
            }
            if ($this->minAmount == 0 && $this->maxAmount != 0) {
                $this->amountLabel = trans("datatables.filters.detailedFilters.amount.to") . " $" . number_format($this->maxAmount, 0, ",", ".");
            }
        }
    }

    /**
     * Set marketplaces filter logic
     */
    public function setMarketplaces()
    {
        $this->marketplaceLabel = null;
        if ($this->selectedMarketplaces != []) {
            foreach ($this->selectedMarketplaces as $selectedMarketplaceKey) {
                foreach ($this->marketplaces as $accMarket) {
                    if ($selectedMarketplaceKey == $accMarket->marketplace->id) {
                        $this->marketplaceLabel .= ($accMarket->marketplace->name == "Woocommerce" ? 'Livriz Commerce' : $accMarket->marketplace->name) . ", ";
                    }
                }
            }
            $this->marketplaceLabel = substr($this->marketplaceLabel, 0, -2);
        } else {
            $this->marketplaceLabel = null;
        }
        $this->displayMarketplaces = false;

    }

    public function setCurrencyStatus(){
        $this->currencyLabel = $this->selectedCurrency;
        $this->displayCurrencyStatus = false;
        $this->hideFilters('displayCurrencyStatus');
    }

    public function setCheckedStatus()
    {
        $this->chekedStatusValue = [];
        $this->checkedStatusLabel = null;
        if ($this->selectedCheckedStatus != []) {
            // foreach ($this->selectedCheckedStatus as $selectedCheckedStatusKey) {
            foreach ($this->checkedStatus as $checked) {

                if (intval($this->selectedCheckedStatus) == ReviewCheckedStatus::getValue($checked)) {
                    $this->checkedStatusLabel .=  trans('review.create.checked_status_option.' . $checked)  . ", ";

                    array_push($this->chekedStatusValue, $checked);
                }
            }
            // }
            $this->checkedStatusLabel = substr($this->checkedStatusLabel, 0, -2);
        } else {
            $this->checkedStatusLabel = null;
        }
        $this->displayCheckedStatus = false;
    }

    public function setBillingStatus()
    {
        $this->billingLabel = null;
        $this->billingLabel = trans($this->table . ".statusTabFilters." . $this->selectedBillingStatus);
        $this->displayBilling = false;
    }

    /**
     * Set status filter logic
     */
    public function setStatus()
    {
        $this->statusLabel = null;
        if ($this->selectedStatus != []) {
            foreach ($this->selectedStatus as $status) {
                if ($status == "all") {
                    $this->statusLabel = trans($this->table . ".statusTabFilters." . $status) . ", ";
                    $this->selectedStatus = $this->filterStatus;
                    break;
                } else {
                    $this->statusLabel .= trans($this->table . ".statusTabFilters." . $status) . ", ";
                }
            }
            $this->statusLabel = substr($this->statusLabel, 0, -2);
        } else {
            $this->statusLabel = null;
        }
        $this->displayStatus = false;
    }

    public function setBranchStates()
    {
        $this->BranchStatesLabel = null;
        if ($this->selectedBranchStates != []) {
            foreach ($this->selectedBranchStates as $state) {
                $this->BranchStatesLabel .= $state . ", ";
            }
            $this->BranchStatesLabel = substr($this->BranchStatesLabel, 0, -2);
        } else {
            $this->BranchStatesLabel = null;
        }
        $this->displayBranchStates = false;
    }

    /**
     * Set pod quantity filter logic
     */
    public function setPodQuantity()
    {
        $this->podCountLabel = null;
        if ($this->selectedPodCount != []) {
            foreach ($this->selectedPodCount as $count) {
                $this->podCountLabel .= $count . ", ";
            }
            $this->podCountLabel = substr($this->podCountLabel, 0, -2);
        } else {
            $this->podCountLabel = null;
        }
        $this->displayPodCount = false;
    }

    /**
     * Set payment method filter logic
     */
    public function setPaymentMethod()
    {
        $this->mappedPaymentMethods = [];
        $this->paymentMethodLabel = null;
        if ($this->selectedPaymentMethods != []) {
            foreach ($this->selectedPaymentMethods as $selected) {
                $this->paymentMethodLabel .= $this->filterPaymentMethods[$selected] . ", ";
                $this->mapPaymentMethods($selected);
            }
            $this->paymentMethodLabel = substr($this->paymentMethodLabel, 0, -2);
        } else {
            $this->paymentMethodLabel = null;
        }
        $this->displayPaymentMethods = false;
    }
    /** Maps selected market payment method to marketlpaces code
     * @param $selected
     */
    public function mapPaymentMethods($selection)
    {
        $paymentMethodService = new PaymentMethodService();
        $methods = $paymentMethodService->mapPaymentMethodsFilter($selection, $this->currentAccountId);
        foreach ($methods as $method) {
            array_push($this->mappedPaymentMethods, $method->marketplace_method_key);
        }
    }

    /**
     * Set shipment method filter logic
     */
    public function setShipmentMethod()
    {
        $this->mappedShipmentMethods = [];
        $this->shipmentMethodsLabel = null;
        if ($this->selectedShipmentMethods != []) {
            foreach ($this->selectedShipmentMethods as $selected) {
                $this->shipmentMethodsLabel .= $this->filterShipmentMethods[$selected] . ", ";
                $this->mapShipmentMethods($selected);
            }
            $this->shipmentMethodsLabel = substr($this->shipmentMethodsLabel, 0, -2);
        } else {
            $this->shipmentMethodsLabel = null;
        }
        $this->displayShipmentMethods = false;
    }

    //TODO make dynamic from database stored config
    /** Maps selected shipment method to marketlpaces code
     * @param $selected
     */
    public function mapShipmentMethods($selection)
    {
        $shipmentMethodService = new ShipmentMethodService();
        $methods = $shipmentMethodService->mapShipmentMethodsFilter($selection, $this->currentAccountId);
        foreach ($methods as $method) {
            array_push($this->mappedShipmentMethods, $method->marketplace_method_key);
        }
    }

    public function customFormatDate($date, $format)
    {
        $date = new DateTime($date);
        $formatedDate = $date->format($format);
        return $formatedDate;
    }

    /**
     * Set date filter logic
     */
    public function setDate()
    {

        if ($this->startDate) {
            $this->dateLabel = $this->customFormatDate($this->startDate, 'd M Y') . " hasta " . $this->customFormatDate($this->endDate, 'd M Y');
        } else {
            $this->dateLabel = trans("datatables.filters.detailedFilters.select");
        }

        if ($this->compareDates === "true") {
            if ($this->compareStartDate) {
                $this->compareDateLabel = "Comparando " . $this->customFormatDate($this->compareStartDate, 'd M Y') . " hasta " . $this->customFormatDate($this->compareEndDate, 'd M Y');
            }
        }
        if ($this->view === "report") {
            $this->applyFilters();
        }
        $this->displayDate = false;
    }

    /**
     * Search filter
     */
    public function searchResults()
    {
        if ($this->searchString === "") {
            $this->applyFilters();
        }
    }

    public function setOrderBy($order)
    {
        switch ($order) {
                //publications
            case "isbn-asc":
                $this->orderColumn = 'products.product_code';
                $this->orderDirection = 'asc';
                break;
            case "isbn-desc":
                $this->orderColumn = 'products.product_code';
                $this->orderDirection = 'desc';
                break;
            case "sync-asc":
                $this->orderColumn = 'publications.updated_at';
                $this->orderDirection = 'asc';
                break;
            case "sync-desc":
                $this->orderColumn = 'publications.updated_at';
                $this->orderDirection = 'desc';
                break;
            case "title-asc":
                $this->orderColumn = 'products.title';
                $this->orderDirection = 'asc';
                break;
            case "title-desc":
                $this->orderColumn = 'products.title';
                $this->orderDirection = 'desc';
                break;
            case "price-asc":
                $this->orderColumn = 'publications.price';
                $this->orderDirection = 'asc';
                break;
            case "price-desc":
                $this->orderColumn = 'publications.price';
                $this->orderDirection = 'desc';
                break;
                //orders
            case "date-asc":
                $this->orderColumn = !$this->section ? 'marketplace_created_at' : 'created_at';
                $this->orderDirection = 'asc';
                break;
            case "date-desc":
                $this->orderColumn = !$this->section ? 'marketplace_created_at' : 'created_at';
                $this->orderDirection = 'desc';
                break;
            case "amount-asc":
                $this->orderColumn = 'total';
                $this->orderDirection = 'asc';
                break;
            case "amount-desc":
                $this->orderColumn = 'total';
                $this->orderDirection = 'desc';
                break;
            case "status-asc":
                $this->orderColumn = 'status';
                $this->orderDirection = 'asc';
                break;
            case "status-desc":
                $this->orderColumn = 'status';
                $this->orderDirection = 'desc';
                break;
                //branches
            case "order-desc":
                $this->orderColumn = 'update_id';
                $this->orderDirection = 'asc';
                break;
            case "order-asc":
                $this->orderColumn = 'update_id';
                $this->orderDirection = 'desc';
                break;
            case "branch-status-asc":
                $this->orderColumn = 'is_disabled';
                $this->orderDirection = 'asc';
                break;
            case "branch-status-desc":
                $this->orderColumn = 'is_disabled';
                $this->orderDirection = 'desc';
                break;
            case "branch-title-asc":
                $this->orderColumn = 'title';
                $this->orderDirection = 'asc';
                break;
            case "branch-title-desc":
                $this->orderColumn = 'title';
                $this->orderDirection = 'desc';
                break;
            case "section-name-asc":
                $this->orderColumn = 'name';
                $this->orderDirection = 'asc';
                break;
            case "section-name-desc":
                $this->orderColumn = 'name';
                $this->orderDirection = 'desc';
                break;
            case "section-status-asc":
                $this->orderColumn = 'status';
                $this->orderDirection = 'asc';
                break;
            case "section-status-desc":
                $this->orderColumn = 'status';
                $this->orderDirection = 'desc';
                break;
            case "date-history-desc":
                $this->orderColumn = 'created_at';
                $this->orderDirection = 'desc';
                break;
            case "date-history-asc":
                $this->orderColumn = 'created_at';
                $this->orderDirection = 'asc';
                break;
            case "customer-date-asc":
                $this->orderColumn = 'customers.created_at';
                $this->orderDirection = 'asc';
                break;
            case "customer-date-desc":
                $this->orderColumn = 'customers.created_at';
                $this->orderDirection = 'desc';
                break;
            case "customer-status-desc":
                $this->orderColumn = 'customers.status';
                $this->orderDirection = 'desc';
                break;
            case "customer-status-asc":
                $this->orderColumn = 'customers.status';
                $this->orderDirection = 'asc';
                break;
            case "customer-first-name-desc":
                $this->orderColumn = 'customers.first_name';
                $this->orderDirection = 'desc';
                break;
            case "customer-first-name-asc":
                $this->orderColumn = 'customers.first_name';
                $this->orderDirection = 'asc';
                break;
            case "customer-last-name-desc":
                $this->orderColumn = 'customers.last_name';
                $this->orderDirection = 'desc';
                break;
            case "customer-last-name-asc":
                $this->orderColumn = 'customers.last_name';
                $this->orderDirection = 'asc';
                break;
            case "customer-username-desc":
                $this->orderColumn = 'customers.username';
                $this->orderDirection = 'desc';
                break;
            case "customer-username-asc":
                $this->orderColumn = 'customers.username';
                $this->orderDirection = 'asc';
                break;
            case "customer-email-desc":
                $this->orderColumn = 'customers.email';
                $this->orderDirection = 'desc';
                break;
            case "customer-email-asc":
                $this->orderColumn = 'customers.email';
                $this->orderDirection = 'asc';
                break;
            case "customer-store-desc":
                $this->orderColumn = 'customers.account_marketplace_id';
                $this->orderDirection = 'desc';
                break;
            case "customer-store-asc":
                $this->orderColumn = 'customers.account_marketplace_id';
                $this->orderDirection = 'asc';
                break;
            case "customer-verified-desc":
                $this->orderColumn = 'customers.meta_data';
                $this->orderDirection = 'desc';
                break;
            case "customer-verified-asc":
                $this->orderColumn = 'customers.meta_data';
                $this->orderDirection = 'asc';
                break;

            case "review-date-asc":
                $this->orderColumn = 'reviews.created_at';
                $this->orderDirection = 'asc';
                break;
            case "review-date-desc":
                $this->orderColumn = 'reviews.created_at';
                $this->orderDirection = 'desc';
                break;
            case "review-status-desc":
                $this->orderColumn = 'reviews.checked_status';
                $this->orderDirection = 'desc';
                break;
            case "review-status-asc":
                $this->orderColumn = 'reviews.checked_status';
                $this->orderDirection = 'asc';
                break;
            case "review-first-name-desc":
                $this->orderColumn = 'customers.first_name';
                $this->orderDirection = 'desc';
                break;
            case "review-first-name-asc":
                $this->orderColumn = 'customers.first_name';
                $this->orderDirection = 'asc';
                break;
            case "review-last-name-desc":
                $this->orderColumn = 'customers.last_name';
                $this->orderDirection = 'desc';
                break;
            case "review-last-name-asc":
                $this->orderColumn = 'customers.last_name';
                $this->orderDirection = 'asc';
                break;
                /*
           * TODO fix orderBy relation customer.name
          case "client-asc":
              $this->orderColumn = 'order_customer.name';
              $this->orderDirection = 'asc';
              break;
          case "client-desc":
              $this->orderColumn = 'order_customer.name';
              $this->orderDirection = 'desc';
              break;
                */
        }
        $this->applyFilters();
    }


    /**
     * Apply all setted filters logic and refresh table query
     */
    public function applyFilters()
    {
        $this->emit('refreshPaginate');
        $filter = [
            "startDate" => $this->startDate,
            "endDate" => $this->endDate,
            "compareStartDate" => $this->compareStartDate,
            "compareEndDate" => $this->compareEndDate,
            "marketplaces" => $this->selectedMarketplaces,
            "checkedStatus" => $this->selectedMarketplaces,
            "status" => $this->selectedStatus,
            "billingStatus" => $this->selectedBillingStatus,
            "minAmount" => $this->minAmount == 0 ? null : $this->minAmount,
            "maxAmount" => $this->maxAmount == 0 ? null : $this->maxAmount,
            "search" => $this->searchString ?? null,
            "orderColumn" => $this->orderColumn,
            "orderDirection" => $this->orderDirection,
            "section" => $this->section ?? null,
            "pod-quantity" => $this->selectedPodCount,
            "branch-states" => $this->selectedBranchStates,
            "payment-methods" => $this->mappedPaymentMethods,
            "shipment-methods" => $this->mappedShipmentMethods,
            "checkedStatus" => $this->chekedStatusValue,
            "currency"=>$this->selectedCurrency
        ];

        session([$this->table . 'Filter' => $filter]);

        $this->filter = $filter;
        $this->emit('refreshTable');
    }

    public function resetFilters()
    {
        session([$this->table . 'Filter' => null]);
        $this->filter = null;
        $this->applyFilters();
    }

    public function exportData()
    {
        $this->exporting = true;
        $this->emit('export-' . $this->table);
    }

    public function exportFinished()
    {
        $this->exporting = false;
    }
}
