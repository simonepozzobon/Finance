@extends('layouts.main.index')
@section('title', 'ToDo List')
@section('page-title', 'ToDo List')
@section('stylesheets')
  {{-- Angular --}}
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
  {{-- Material Design --}}
  <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
  <script src="//ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>

  <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('content')
  <div class="clearfix" ng-app="todoApp" ng-controller="mainController" ng-cloak>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#todoCreate">
          Add New Todo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="todoCreate" tabindex="-1" role="dialog" aria-labelledby="todoCreateTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form ng-submit="submitTodo()" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header">
                  <h5 class="modal-title" id="todoCreateTitle">Add New Todo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" ng-model="todoData.name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" rows="8" class="form-control" ng-model="todoData.description">Description</textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input id="start_date" type="text" name="start_date" class="form-control" ng-model="todoData.start_date">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input id="end_date" type="text" name="end_date" class="form-control" ng-model="todoData.end_date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="completed">Completed</label>
                      <input type="text" name="completed" class="form-control" ng-model="todoData.completed">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add ToDo</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <table class="table table-hover">
          <thead>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Tools</th>
          </thead>
          <tbody>
            <tr ng-repeat="todo in todos">
              <td class="align-middle">/% todo.name %/</td>
              <td class="align-middle">/% todo.start_date %/</td>
              <td class="align-middle">/% todo.end_date %/</td>
              <td class="align-middle" ng-if="todo.completed == true"><span class="align-middle alert alert-success">Complete</span></td>
              <td class="align-middle" ng-if="todo.completed == false"><span class="align-middle alert alert-danger">Incomplete</span></td>
              <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#todoUpdate" ng-click="getTodo(todo.id)">
                    Edit
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="todoUpdate" tabindex="-1" role="dialog" aria-labelledby="todoUpdateTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <form ng-submit="editTodo(todo.id)" method="post">
                          {{ csrf_field() }}
                          {{ method_field('post') }}
                          <div class="modal-header">
                            <h5 class="modal-title" id="todoUpdateTitle">Edit ToDo - Id: /% todo.id %/</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="todoData.name">
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" class="form-control" ng-model="todoData.description">Description</textarea>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date_edit" type="text" name="start_date" class="form-control" ng-model="todoData.start_date">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date_edit" type="text" name="end_date" class="form-control" ng-model="todoData.end_date">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="completed">Completed</label>
                                <input type="text" name="completed" class="form-control" ng-model="todoData.completed">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add ToDo</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <a href="" ng-click="deleteTodo(todo.id)" class="btn btn-danger">Delete</a>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
      // Define the service
      angular.module('todoService', [])
              .factory('Todo', function($http, CSRF_TOKEN){
                // Get all the category
                return {
                  get : function() {
                    return $http.get('todo/api');
                  },

                  save : function(todoData) {
                    console.log($.param(todoData));
                      return $http({
                        method: 'POST',
                        url: '{{ route('api.todos.store') }}',
                        data: $.param(todoData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  update : function(todoData, id) {
                    console.log($.param(todoData));
                      return $http({
                        method: 'PUT',
                        url: '{{ route('api.todos.index') }}/'+id,
                        data: $.param(todoData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  destroy : function(id) {
                      return $http({
                        method: 'DELETE',
                        url: '{{ route('api.todos.index') }}/'+id
                      });
                  }
                }
              });

      // Define the controller
      angular.module('mainCtrl', [])
              .controller('mainController', function($scope, $http, Todo) {
                // models
                $scope.todoData = {} // Initialize the object

                // get function from factory of the Todo service
                Todo.get().then(function(response) {
                    $scope.todos = response.data;
                  });

                $scope.submitTodo = function() {
                  console.log($scope.todoData);
                  Todo.save($scope.todoData)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#todoCreate').modal('hide');
                            });
                            Todo.get().then(function(response) {
                              $scope.todos = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.deleteTodo = function(id) {
                  Todo.destroy(id)
                          .then(function successCallback(response) {
                            Todo.get().then(function(response) {
                              $scope.todos = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.editTodo = function(id) {
                  console.log($scope.todoData);
                  Todo.update($scope.todoData, id)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#todoUpdate').modal('hide');
                            });
                            Todo.get().then(function(response) {
                              $scope.todos = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.getTodo = function(id) {
                  $http.get('todo/api/'+id+'/edit').then(function(response) {
                    $scope.todoData = response.data;
                    if ($scope.todoData.completed == true) {
                      $scope.todoData.completed = 1;
                    } else if ($scope.todoData.completed == false) {
                      $scope.todoData.completed = 0;
                    }
                    console.log($scope.todoData);
                  });
                };

                $scope.changeDate = function() {
                  jQuery(function () {
                      jQuery('#start_date').datetimepicker({
                        onChangeDateTime:function(dp,$input){
                          $scope.start_date = $input.val();
                        }
                      });
                      jQuery('#end_date').datetimepicker({
                        onChangeDateTime:function(dp,$input){
                          $scope.end_date = $input.val();
                        }
                      });
                      jQuery('#start_date_edit').datetimepicker({
                        onChangeDateTime:function(dp,$input){
                          $scope.start_date = $input.val();
                        }
                      });
                      jQuery('#end_date_edit').datetimepicker({
                        onChangeDateTime:function(dp,$input){
                          $scope.end_date = $input.val();
                        }
                      });
                  });
                };

                $scope.changeDate();
              });

      // Define the Application
      var todoApp =
      angular.module('todoApp', [
                'mainCtrl',
                'todoService',
                'ngMaterial',
              ])
              .constant("CSRF_TOKEN", '{{ csrf_token() }}')
              .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('/%');
                $interpolateProvider.endSymbol('%/');
              });


    </script>
@endsection
