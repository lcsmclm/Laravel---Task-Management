@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                  <!-- <a href='/new'>Add Task</a> -->
                  <div class='single-form'>
                    @if($errors->any())
                        <h2>Please type in a task.</h2>
                    @endif
                  <h2 class='news-title'>New Task</h2>
                      <form action= "{{ url('new/add') }}" method="post">
                          {{ csrf_field() }} <!-- //grabs auto generated session token */ -->
                          <label class='cat hidden' for="new-post-category">Category: </label>
                          <select name="new-post-category" id='new-post-category'>
                            <option value="1" selected>General</option>
                            <option value="2">Daily</option>
                            <option value="3">Business</option>
                            <option value="4">School</option>
                            <option value="5">Chores</option>
                            <option value="6">Reminder</option>
                          </select>
                          <br>
                          <label class='cat hidden' for="new-post-msg">Task: </label>
                          <textarea type="text" style='min-height: 150px' name="new-post-msg" id="postmsg" value="">{{ old('new-post-msg') }}</textarea><br>
                          <input class='news submit' value='Add Task' type="submit">
                      </form>
                    </div>
                    <div class='search-form'>
                      <form method='get' action='index.php'>
                        <label  name='searchstring' for="searchstring"><i class="fa fa-search" aria-hidden="true"></i></label>
                        <input type="search" placeholder='Search...' name="searchstring" id="searchstring" value='<?php if(isset($_GET['searchstring'])){echo$q;}?>'>
                      </form>
                    </div>
                  <br>
                  <h2>Tasks:</h2>
                  <ul>
                    @if(!count($lists))
                    <h1>No tasks to do!</h1>
                    @else

                  @foreach($lists as $list)
                  <li>{{$list->title}}
                        <a href='complete/{{$list->id}}'>Complete</a>
                    <ul>
                      <li>Category: {{$list->category}}</li>
                      <li>User: {{$list->user->name}}</li>
                        <li>Active: {{$list->active}}</li>
                    </ul>
                  </li>
                  @endforeach
                    @endif
                </ul>
                <h2>Completed:</h2>
                <ul>
                @foreach($completed as $complist)
                <li>{{$complist->title}}
                  <a href='/delete/{{$complist->id}}'>Delete</a>
                  <ul>
                    <li>Category: {{$complist->category}}</li>
                    <li>User: {{$complist->user->name}}</li>
                      <li>Active: {{$complist->active}}</li>
                  </ul>
                </li>
                @endforeach
              </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
