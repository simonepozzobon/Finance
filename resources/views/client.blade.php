@extends('layouts.main.index', ['page_active' => 'clients'])
@section('title', 'Clients')
@section('page-title', 'Clients')
@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('content')
  <div class="clearfix" ng-app="projectApp" ng-controller="mainController" ng-cloak>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#projectCreate">
          Add New Project
        </button>

        <!-- Modal -->
        <div class="modal fade" id="projectCreate" tabindex="-1" role="dialog" aria-labelledby="projectCreateTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form ng-submit="submitProject()" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header">
                  <h5 class="modal-title" id="projectCreateTitle">Add New Project</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" ng-model="projectData.name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" rows="8" class="form-control" ng-model="projectData.description">Description</textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input id="start_date" type="text" name="start_date" class="form-control" ng-model="projectData.start_date">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input id="end_date" type="text" name="end_date" class="form-control" ng-model="projectData.end_date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="client_id">Client</label>
                      <input type="text" name="client_id" class="form-control" ng-model="projectData.client_id">
                    </div>
                    <div class="form-group">
                      <label for="status_id">Status</label>
                      <select class="form-control" name="status_id" ng-model="projectData.status_id">
                        <option ng-repeat="status in statuses" value="@{{ status.id }}" class="text-@{{ status.class }}">@{{ status.message }}</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Project</button>
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
              <a href="#" ng-click="sortType = 'client'; sortReverse = !sortReverse">Client</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'completed'; sortReverse = !sortReverse">Status</a>
            </th>
            <th>Tools</th>
          </thead>
          <tbody>
            <tr ng-repeat="project in projects | orderBy:sortType:sortReverse">
              <td class="align-middle">@{{ project.name }}</td>
              <td class="align-middle">@{{ project.start_date }}</td>
              <td class="align-middle">@{{ project.end_date }}</td>
              <td class="align-middle">@{{ project.client.name }}</td>
              <td class="align-middle"><span class="align-middle alert alert-@{{ project.status.class }}">@{{ project.status.message }}</span></td>
              <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                  {{-- View Modal Trigger --}}
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#projectView" ng-click="showProject(project.id)">
                    View
                  </button>
                  {{-- View Modal --}}
                  <div class="modal fade" id="projectView" tabindex="-1" role="dialog" aria-labelledby="projectViewTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="projectViewTitle">Edit Project - Id: @{{ projectData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <h4>Name</h4>
                                @{{ projectData.name }}
                              </div>
                              <div class="form-group">
                                <h4>Description</h4>
                                @{{ projectData.description }}
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>Start Date</h4>
                                    @{{ projectData.start_date }}
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>End Date</h4>
                                    @{{ projectData.end_date }}
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <h4 class="mb-4">Status</h4>
                                <span class="align-middle alert alert-@{{ projectData.status.class }}">@{{ projectData.status.message }}</span>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- Edit Modal Trigger --}}
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#projectUpdate" ng-click="getProject(project.id)">
                    Edit
                  </button>
                  {{-- Edit Modal --}}
                  <div class="modal fade" id="projectUpdate" tabindex="-1" role="dialog" aria-labelledby="projectUpdateTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <form ng-submit="editProject(projectData.id)" method="post">
                          {{ csrf_field() }}
                          {{ method_field('post') }}
                          <div class="modal-header">
                            <h5 class="modal-title" id="projectUpdateTitle">Edit Project - Id: @{{ projectData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="projectData.name">
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" class="form-control" ng-model="projectData.description">Description</textarea>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date_edit" type="text" name="start_date" class="form-control" ng-model="projectData.start_date">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date_edit" type="text" name="end_date" class="form-control" ng-model="projectData.end_date">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="client_id">Client</label>
                                <select class="form-control" name="client_id" ng-model="projectData.client_id">
                                  <option ng-repeat="client in clientsData" value="@{{ client.id }}">@{{ client.name }}</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" name="status_id" ng-model="projectData.status_id">
                                  <option ng-repeat="status in statusesData" value="@{{ status.id }}" class="text-@{{ status.class }}">@{{ status.message }}</option>
                                </select>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Project</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- Delete Button --}}
                  <a href="" ng-click="deleteProject(project.id)" class="btn btn-danger">Delete</a>
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
      angular.module('projectService', [])
              .factory('Project', function($http, CSRF_TOKEN){
                // Get all the category
                return {
                  get : function() {
                    return $http.get('{{ route('project-api.index') }}');
                  },

                  save : function(projectData) {
                    console.log($.param(projectData));
                      return $http({
                        method: 'POST',
                        url: '{{ route('project-api.store') }}',
                        data: $.param(projectData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  update : function(projectData, id) {
                    console.log($.param(projectData));
                      return $http({
                        method: 'PUT',
                        url: '{{ route('project-api.index') }}/'+id,
                        data: $.param(projectData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  destroy : function(id) {
                      return $http({
                        method: 'DELETE',
                        url: '{{ route('project-api.index') }}/'+id
                      });
                  }
                }
              });

      // Define the controller
      angular.module('mainCtrl', [])
              .controller('mainController', function($scope, $http, Project) {
                // models
                $scope.projectData = {} // Initialize the object
                // Sorting Table
                $scope.sortType     = 'id'; // set the default sort type
                $scope.sortReverse  = false;
                // get function from factory of the Project service
                Project.get().then(function(response) {
                    $scope.projects = response.data.project;
                    $scope.statuses = response.data.status;
                    $scope.clients = response.data.client;
                  });

                $scope.submitProject = function() {
                  Project.save($scope.projectData)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#projectCreate').modal('hide');
                            });
                            Project.get().then(function(response) {
                              $scope.projects = response.data.project;
                              $scope.statuses = response.data.status;
                              $scope.clients = response.data.client;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.getProject = function(id) {
                  $http.get('{{ route('project-api.index') }}/'+id+'/edit').then(function(response) {
                    console.log(response.data.status);
                    $scope.projectData = response.data.project;
                    $scope.statusesData = response.data.status;
                    $scope.clientsData = response.data.client;
                  });
                };

                $scope.editProject = function(id) {
                  Project.update($scope.projectData, id)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#projectUpdate').modal('hide');
                            });
                            Project.get().then(function(response) {
                              $scope.projects = response.data.project;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.showProject = function(id) {
                  $http.get('{{ route('project-api.index') }}/'+id).then(function(response) {
                    $scope.projectData = response.data;
                  });
                }

                $scope.deleteProject = function(id) {
                  Project.destroy(id)
                          .then(function successCallback(response) {
                            Project.get().then(function(response) {
                              $scope.projects = response.data.project;
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
      var projectApp =
      angular.module('projectApp', [
                'mainCtrl',
                'projectService',
                'ngMaterial',
              ])
              .constant("CSRF_TOKEN", '{{ csrf_token() }}');


    </script>
@endsection
