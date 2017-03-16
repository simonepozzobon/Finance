@extends('layouts.main.index')
@section('title', 'ToDo List')
@section('page-title', 'ToDo List')
@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('content')
  <div class="clearfix" ng-app="statusApp" ng-controller="mainController" ng-cloak>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#statusCreate">
          Add New Todo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="statusCreate" tabindex="-1" role="dialog" aria-labelledby="statusCreateTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form ng-submit="submitTodo()" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header">
                  <h5 class="modal-title" id="statusCreateTitle">Add New Todo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" ng-model="statusData.name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" rows="8" class="form-control" ng-model="statusData.description">Description</textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input id="start_date" type="text" name="start_date" class="form-control" ng-model="statusData.start_date">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input id="end_date" type="text" name="end_date" class="form-control" ng-model="statusData.end_date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="completed">Completed</label>
                      <md-switch ng-model="statusData.completed" aria-label="Switch 2"></md-switch>
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
            <th>
              <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">Name</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'start_date'; sortReverse = !sortReverse">Start Date</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'end_date'; sortReverse = !sortReverse">End Date</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'completed'; sortReverse = !sortReverse">Status</a>
            </th>
            <th>Tools</th>
          </thead>
          <tbody>
            <tr ng-repeat="status in statuses | orderBy:sortType:sortReverse">
              <td class="align-middle">/% status.name %/</td>
              <td class="align-middle">/% status.start_date %/</td>
              <td class="align-middle">/% status.end_date %/</td>
              <td class="align-middle" ng-if="status.completed == true"><span class="align-middle alert alert-success">Completed</span></td>
              <td class="align-middle" ng-if="status.completed == false"><span class="align-middle alert alert-danger">Incomplete</span></td>
              <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                  {{-- View Modal Trigger --}}
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#statusView" ng-click="showTodo(status.id)">
                    View
                  </button>
                  {{-- View Modal --}}
                  <div class="modal fade" id="statusView" tabindex="-1" role="dialog" aria-labelledby="statusViewTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="statusViewTitle">View ToDo - Id: /% statusData.id %/</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <h4>Name</h4>
                                /% statusData.name %/
                              </div>
                              <div class="form-group">
                                <h4>Description</h4>
                                <p>/% statusData.description %/</p>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>Start Date</h4>
                                    /% statusData.start_date %/
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>End Date</h4>
                                    /% statusData.end_date %/
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <h4 class="mb-4">Completed</h4>
                                <span ng-if="status.completed == true" class="align-middle alert alert-success">Completed</span>
                                <span ng-if="status.completed == false" class="align-middle alert alert-danger">Incomplete</span>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- Edit Modal Trigger --}}
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusUpdate" ng-click="getTodo(status.id)">
                    Edit
                  </button>
                  {{-- Edit Modal --}}
                  <div class="modal fade" id="statusUpdate" tabindex="-1" role="dialog" aria-labelledby="statusUpdateTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <form ng-submit="editTodo(statusData.id)" method="post">
                          {{ csrf_field() }}
                          {{ method_field('post') }}
                          <div class="modal-header">
                            <h5 class="modal-title" id="statusUpdateTitle">Edit ToDo - Id: /% statusData.id %/</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="statusData.name">
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" class="form-control" ng-model="statusData.description">Description</textarea>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date_edit" type="text" name="start_date" class="form-control" ng-model="statusData.start_date">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date_edit" type="text" name="end_date" class="form-control" ng-model="statusData.end_date">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="completed">Completed</label>
                                <md-switch ng-model="statusData.completed" aria-label="Switch 1"></md-switch>
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
                  {{-- Delete Button --}}
                  <a href="" ng-click="deleteTodo(status.id)" class="btn btn-danger">Delete</a>
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
      angular.module('statusService', [])
              .factory('Todo', function($http, CSRF_TOKEN){
                // Get all the category
                return {
                  get : function() {
                    return $http.get('{{ route('status-api.index') }}');
                  },

                  save : function(statusData) {
                    console.log($.param(statusData));
                      return $http({
                        method: 'POST',
                        url: '{{ route('status-api.store') }}',
                        data: $.param(statusData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  update : function(statusData, id) {
                    console.log($.param(statusData));
                      return $http({
                        method: 'PUT',
                        url: '{{ route('status-api.index') }}/'+id,
                        data: $.param(statusData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  destroy : function(id) {
                      return $http({
                        method: 'DELETE',
                        url: '{{ route('status-api.index') }}/'+id
                      });
                  }
                }
              });

      // Define the controller
      angular.module('mainCtrl', [])
              .controller('mainController', function($scope, $http, Todo) {
                // models
                $scope.statusData = {} // Initialize the object
                // Sorting Table
                $scope.sortType     = 'id'; // set the default sort type
                $scope.sortReverse  = true;
                // get function from factory of the Todo service
                Todo.get().then(function(response) {
                    $scope.statuses = response.data;
                  });

                $scope.submitTodo = function() {
                  Todo.save($scope.statusData)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#statusCreate').modal('hide');
                            });
                            Todo.get().then(function(response) {
                              $scope.statuses = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.editTodo = function(id) {
                  Todo.update($scope.statusData, id)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#statusUpdate').modal('hide');
                            });
                            Todo.get().then(function(response) {
                              $scope.statuses = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.getTodo = function(id) {
                  $http.get('{{ route('status-api.index') }}/'+id+'/edit').then(function(response) {
                    $scope.statusData = response.data;
                  });
                };

                $scope.showTodo = function(id) {
                  $http.get('{{ route('status-api.index') }}/'+id).then(function(response) {
                    $scope.statusData = response.data;
                  });
                }

                $scope.deleteTodo = function(id) {
                  Todo.destroy(id)
                          .then(function successCallback(response) {
                            Todo.get().then(function(response) {
                              $scope.statuses = response.data;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
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
      var statusApp =
      angular.module('statusApp', [
                'mainCtrl',
                'statusService',
                'ngMaterial',
              ])
              .constant("CSRF_TOKEN", '{{ csrf_token() }}')
              .config(function($interpolateProvider) {
                $interpolateProvider.startSymbol('/%');
                $interpolateProvider.endSymbol('%/');
              });


    </script>
@endsection
