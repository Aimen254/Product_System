<div class="row">
<div class="col-md-12">
<div class="float-end">
<a href="#"  title="{{__('Create New User')}}" onclick="show()" class="btn btn-sm btn-primary">
                        Advance Filters
                    </a>
</div>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="col-12">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <div class="row"  id="filters" style="display:none;">
                             <div class="col-md-2">
                                <select id="project" name="" onchange="get()"  class="form-control  create">                       
                                    <option value="project">Project</option> 
                                    @foreach($tasks as $task)
                                    @if($projects = $task->projects())
                                    @foreach($projects as $key => $project)
                                    <option >{{ $project->project_name }}</option>
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                             </div>
                             <div class="col-md-2">
                                <select id="stage" name="" onchange="stage()"  class="form-control  stage"> 
                                <option value="stage">Stage</option> 
                                @foreach(\App\Models\ProjectTask:: $stages as $key => $val)
                                    <option>{{ __($val) }}</option>
                                @endforeach
                                </select>
                            </div>
                             <div class="col-md-2">
                                <select id="user" name="" onchange="user()"  class="form-control  create">                       
                                    <option value="user">Assignee</option> 
                                    @foreach($tasks as $task)
                                    @if($users = $task->users())
                                    @foreach($users as $key => $user)
                                    <option >{{ $user->name }}</option>
                                    @endforeach
                                    @endif
                                    @endforeach
                                </select>
                             </div>
                        </div>
                         
                         
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">{{__('Name')}}</th>
                                <th scope="col">{{__('Stage')}}</th>
                                <th scope="col">{{__('Priority')}}</th>
                                <th scope="col">{{__('End Date')}}</th>
                                <th scope="col">{{__('Assigned To')}}</th>
                                <th scope="col">{{__('Project')}}</th>
                                <th scope="col">{{__('Completion')}}</th>
                                <th scope="col"></th>
                            </tr>
                             
                            </thead>
                            <tbody class="list" id ="myTable">
                            @if(count($tasks) > 0)
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>
                                            <span class="h6 text-sm font-weight-bold mb-0"><a href="{{ route('projects.tasks.index',$task->project->id) }}">{{ $task->name }}</a></span>
                                            <span class="d-flex text-sm text-muted justify-content-between">
                                        <p class="m-0">{{ $task->project->project_name }}</p>
                                    <span class="me-5 badge p-2 px-3 rounded bg-{{ (\Auth::user()->checkProject($task->project_id) == 'Owner') ? 'success' : 'warning'  }}">
                                        {{ __(\Auth::user()->checkProject($task->project_id)) }}</span>
                                </span>
                                        </td>
                                        <td>{{ $task->stage->name }}</td>
                                        <td>
                                            <span class="status_badge badge p-2 px-3 rounded bg-{{__(\App\Models\ProjectTask::$priority_color[$task->priority])}}">{{ __(\App\Models\ProjectTask::$priority[$task->priority]) }}</span>
                                        </td>
                                        <td class="{{ (strtotime($task->end_date) < time()) ? 'text-danger' : '' }}">{{ Utility::getDateFormated($task->end_date) }}</td>
                                        <td>
                                            <div class="avatar-group">
                                                @if($task->users()->count() > 0)
                                                    @if($users = $task->users())
                                                        @foreach($users as $key => $user)
                                                            @if($key<3)
                                                                <a href="#" class="avatar rounded-circle avatar-sm">
                                                                    <img data-original-title="{{(!empty($user)?$user->name:'')}}" @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif title="{{ $user->name }}" class="hweb">
                                                                </a>
                                                            @else
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if(count($users) > 3)
                                                        <a href="#" class="avatar rounded-circle avatar-sm">
                                                            <img  data-original-title="{{(!empty($user)?$user->name:'')}}" @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('/storage/uploads/avatar/avatar.png')}}" @endif class="hweb">
                                                        </a>
                                                    @endif
                                                @else
                                                    {{ __('-') }}
                                                @endif
                                            </div>
                                        </td>
                                           <td>{{ $task->project->project_name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="completion mr-2">{{ $task->taskProgress()['percentage'] }}</span>
                                                {{--<div>
                                                    <div class="progress" style="width: 100px;">
                                                        <div class="progress-bar bg-{{ $task->taskProgress()['color'] }}" role="progressbar" aria-valuenow="{{ $task->taskProgress()['percentage'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $task->taskProgress()['percentage'] }};"></div>
                                                    </div>
                                                </div>--}}
                                            </div>
                                        </td>
                                        <td class="text-end w-15">
                                            <div class="actions">
                                                <a class="action-item px-1" data-bs-toggle="tooltip" title="{{__('Attachment')}}" data-original-title="{{__('Attachment')}}">
                                                    <i class="ti ti-paperclip mr-2"></i>{{ count($task->taskFiles) }}
                                                </a>
                                                <a class="action-item px-1" data-bs-toggle="tooltip" title="{{__('Comment')}}" data-original-title="{{__('Comment')}}">
                                                    <i class="ti ti-brand-hipchat mr-2"></i>{{ count($task->comments) }}
                                                </a>
                                                <a class="action-item px-1" data-bs-toggle="tooltip" title="{{__('Checklist')}}" data-original-title="{{__('Checklist')}}">
                                                    <i class="ti ti-list-check mr-2"></i>{{ $task->countTaskChecklist() }}
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th scope="col" colspan="7"><h6 class="text-center">{{__('No tasks found')}}</h6></th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function get(){
        var  filter,  table, tr, td,  i;
        var pro = document.getElementById("project");
        filter = pro.value.toUpperCase();
        
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[5];
            if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1)  {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        } 
    }
    
     function stage(){
        var  filter,  table, tr, td,  i;
        var st = document.getElementById("stage");
        filter = st.value.toUpperCase();
        
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1)  {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        } 
    }
  
   function user(){
        var  filter,  table, tr, td,  i;
        var user = document.getElementById("user");
        filter = user.value.toUpperCase();
        
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[4];
            if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1)  {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }       
        } 
    }
      function show(){
        $("#filters").show();
    }
</script>