<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="{{route('acounts.index')}}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'acounts.index' ) ? ' active' : '' }}">{{__('Acounts')}} <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <!-- <a href="{{ route('warehouse.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'warehouse.index' ) ? 'active' : '' }}">{{__('Ware House')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a> -->

        <a href="{{ route('stores.index') }}" class="list-group-item list-group-item-action border-0 {{ (Request::route()->getName() == 'warehouse.index' ) ? 'active' : '' }}">{{__('Stores')}}<div class="float-end"><i class="ti ti-chevron-right"></i></div></a>
    </div>
</div>
