<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
    <div>
      <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
      <p class="app-sidebar__user-designation">Admin Access</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item active" href="{{url('/')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
    <li class="treeview {{call_user_func_array('Request::is', (array)['incomes*']) ? 'is-expanded' : ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Incomes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">

        <li><a class="treeview-item" href="#"><i class="icon fa fa-angle-double-right"></i>Invoices</a></li>

        <li><a class="treeview-item" href="#" target="_blank" rel="noopener"><i class="icon fa fa-angle-double-right"></i> Revenues</a></li>

        <li><a class="treeview-item" href="#"><i class="icon fa fa-angle-double-right"></i> Customers</a></li>
      
      </ul>
    </li>
    
    <li class="treeview {{call_user_func_array('Request::is', (array)['expenses*']) ? 'is-expanded' : ''}}" ><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-shopping-cart "></i><span class="app-menu__label">Expenses</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{{route('bills.index')}}"><i class="icon fa fa-angle-double-right"></i> Bills</a></li>
        <li><a class="treeview-item" href="{{route('payments.index')}}"><i class="icon fa fa-angle-double-right"></i> Payments</a></li>
        <li><a class="treeview-item" href="{{route('vendors.index')}}"><i class="icon fa fa-angle-double-right"></i> Vendors</a></li>
          <li class="{{call_user_func_array('Request::is', (array)['expenses/tours*']) ? 'active_subtab' : ''}}"><a class="treeview-item" href="{{route('tours.index')}}"><i class="icon fa fa-angle-double-right"></i> Tours</a></li>
      
      </ul>
    </li>
    {{-- Hr Module to handle employees --}}
      <li class="treeview {{call_user_func_array('Request::is', (array)['hrd*']) ? 'is-expanded' : ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-group "></i><span class="app-menu__label">HRD</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li class={{call_user_func_array('Request::is', (array)['hrd/employees*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('employees.index')}}"><i class="icon fa fa-angle-double-right"></i>Employees</a></li>
          <li class={{call_user_func_array('Request::is', (array)['hrd/approvals*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('approvals.index')}}"><i class="icon fa fa-angle-double-right"></i>Approvals</a></li>
      </ul>
    </li>
    {{-- end of module --}}
    <li class="treeview {{call_user_func_array('Request::is', (array)['tender*']) ? 'is-expanded' : ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-group "></i><span class="app-menu__label">Tenders</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li class={{call_user_func_array('Request::is', (array)['tender_type*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('tender_type.index')}}"><i class="icon fa fa-angle-double-right"></i>Tender Types</a></li>
        <li class={{call_user_func_array('Request::is', (array)['tender_category*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('tender_category.index')}}"><i class="icon fa fa-angle-double-right"></i>Tender Categories</a></li>
        <li class={{call_user_func_array('Request::is', (array)['tender_master*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('tender_master.index')}}"><i class="icon fa fa-angle-double-right"></i>Tender Mast</a></li>
      </ul>
    </li>
    <li class="treeview {{call_user_func_array('Request::is', (array)['settings*']) ? 'is-expanded' : ''}}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog "></i><span class="app-menu__label">Settings</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href=""><i class="icon fa fa-angle-double-right"></i> General</a></li>
        <li><a class="treeview-item" href="{{route('categories.index')}}"><i class="icon fa fa-angle-double-right"></i> Categories</a></li>
        <li><a class="treeview-item" href="{{route('expense_in_user.create')}}"><i class="icon fa fa-angle-double-right"></i> Expense In User</a></li>          
        <li><a class="treeview-item" href="{{route('expense_permit_user.create')}}"><i class="icon fa fa-angle-double-right"></i> Expense Permit User</a></li>          
        <li><a class="treeview-item" href=""><i class="icon fa fa-angle-double-right"></i> Payment Method</a></li>
        <li class={{call_user_func_array('Request::is', (array)['settings/designations*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('designations.index')}}"><i class="icon fa fa-angle-double-right"></i> Designation </a></li>
        <li class={{call_user_func_array('Request::is', (array)['settings/statuses*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('statuses.index')}}"><i class="icon fa fa-angle-double-right"></i> Statuses </a></li>
        <li class={{call_user_func_array('Request::is', (array)['settings/grades*']) ? 'active_subtab' : ''}}><a class="treeview-item" href="{{route('grades.index')}}"><i class="icon fa fa-angle-double-right"></i> Grades </a></li>
      
      </ul>
    </li>

  </ul>
</aside>