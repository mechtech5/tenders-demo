<ul class="nav nav-pills nav-justified">
{{-- 	<li class="nav-item">
		<a class="nav-link main" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'main'])}}">Main</a>
	</li> --}}
	<li class="nav-item">
		<a class="nav-link official" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'official'])}}">Official</a>
	</li>
	<li class="nav-item">
		<a class="nav-link personal" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'personal'])}}">Personal</a>
	</li>
	<li class="nav-item">
		<a class="nav-link academics" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'academics'])}}">Academics</a>
	</li>
	<li class="nav-item">
		<a class="nav-link experience" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'experience'])}}">Experience</a>
	</li>
	<li class="nav-item">
		<a class="nav-link nominee" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'nominee'])}}">Nominee</a>
	</li>
	<li class="nav-item">
		<a class="nav-link bankdetails" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'bankdetails'])}}">Bank Details</a>
	</li>
	<li class="nav-item">
		<a class="nav-link documents" href="{{route('employee.show_page',['id'=>$employee->id,'tab'=>'documents'])}}">Documents</a>
	</li>
</ul>