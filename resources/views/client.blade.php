@extends('layouts.main.index', ['page_active' => 'clients'])
@section('title', 'Clients')
@section('page-title', 'Clients')
@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('content')
  <div class="clearfix" ng-app="clientApp" ng-controller="mainController" ng-cloak>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#clientCreate">
          Add New Client
        </button>

        <!-- Modal -->
        <div class="modal fade" id="clientCreate" tabindex="-1" role="dialog" aria-labelledby="clientCreateTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form ng-submit="submitClient()" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header">
                  <h5 class="modal-title" id="clientCreateTitle">Add New Client</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" ng-model="clientData.name">
                    </div>
                    <div class="form-group">
                      <label for="street">Street</label>
                      <input type="text" name="street"  class="form-control" ng-model="clientData.street" placeholder="Street">
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="city">City</label>
                          <input type="text" name="city" class="form-control" ng-model="clientData.city" placeholder="City">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="postal_code">Postal Code</label>
                          <input type="text" name="postal_code" class="form-control" ng-model="clientData.postal_code" placeholder="20123">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="country">Coutry</label>
                          <input type="text" name="country" class="form-control" ng-model="clientData.country" placeholder="Italy">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="vat">Vat Number</label>
                          <input type="text" name="vat" class="form-control" ng-model="clientData.vat" placeholder="XXXXXXXXXXX">
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Client</button>
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
              <a href="#" ng-click="sortType = 'active_projects'; sortReverse = !sortReverse">Active Projects</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'total_projects'; sortReverse = !sortReverse">Total Projects</a>
            </th>
            <th>
              <a href="#" ng-click="sortType = 'country'; sortReverse = !sortReverse">Country</a>
            </th>
            <th>Tools</th>
          </thead>
          <tbody>
            <tr ng-repeat="client in clients | orderBy:sortType:sortReverse">
              <td class="align-middle">@{{ client.name }}</td>
              <td class="align-middle text-center">@{{ client.active_projects }}</td>
              <td class="align-middle text-center">@{{ client.total_projects }}</td>
              <td class="align-middle">@{{ client.country }}</td>
              <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                  {{-- View Modal Trigger --}}
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#clientView" ng-click="showClient(client.id)">
                    View
                  </button>
                  {{-- View Modal --}}
                  <div class="modal fade" id="clientView" tabindex="-1" role="dialog" aria-labelledby="clientViewTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="clientViewTitle">Edit Client - Id: @{{ clientData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <h4>Name</h4>
                                @{{ clientData.name }}
                              </div>
                              <div class="form-group">
                                <h4>Street</h4>
                                @{{ clientData.street }}
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>City</h4>
                                    @{{ clientData.city }}
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>Postal Code</h4>
                                    @{{ clientData.postal_code }}
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <h4 class="mb-4">Country</h4>
                                @{{ clientData.country }}
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- Edit Modal Trigger --}}
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clientUpdate" ng-click="getClient(client.id)">
                    Edit
                  </button>
                  {{-- Edit Modal --}}
                  <div class="modal fade" id="clientUpdate" tabindex="-1" role="dialog" aria-labelledby="clientUpdateTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <form ng-submit="editClient(clientData.id)" method="post">
                          {{ csrf_field() }}
                          {{ method_field('post') }}
                          <div class="modal-header">
                            <h5 class="modal-title" id="clientUpdateTitle">Edit Client - Id: @{{ clientData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" name="name" class="form-control" ng-model="clientData.name">
                            </div>
                            <div class="form-group">
                              <label for="street">Street</label>
                              <input type="text" name="street"  class="form-control" ng-model="clientData.street" placeholder="Street">
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="city">City</label>
                                  <input type="text" name="city" class="form-control" ng-model="clientData.city" placeholder="City">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="postal_code">Postal Code</label>
                                  <input type="text" name="postal_code" class="form-control" ng-model="clientData.postal_code" placeholder="20123">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="country">Coutry</label>
                                  <input type="text" name="country" class="form-control" ng-model="clientData.country" placeholder="Italy">
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="vat">Vat Number</label>
                                  <input type="text" name="vat" class="form-control" ng-model="clientData.vat" placeholder="XXXXXXXXXXX">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Client</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- Delete Button --}}
                  <a href="" ng-click="deleteClient(client.id)" class="btn btn-danger">Delete</a>
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
      angular.module('clientService', [])
              .factory('Client', function($http, CSRF_TOKEN){
                // Get all the category
                return {
                  get : function() {
                    return $http.get('{{ route('client-api.index') }}');
                  },

                  save : function(clientData) {
                    console.log($.param(clientData));
                      return $http({
                        method: 'POST',
                        url: '{{ route('client-api.store') }}',
                        data: $.param(clientData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  update : function(clientData, id) {
                    console.log($.param(clientData));
                      return $http({
                        method: 'PUT',
                        url: '{{ route('client-api.index') }}/'+id,
                        data: $.param(clientData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  destroy : function(id) {
                      return $http({
                        method: 'DELETE',
                        url: '{{ route('client-api.index') }}/'+id
                      });
                  }
                }
              });

      // Define the controller
      angular.module('mainCtrl', [])
              .controller('mainController', function($scope, $http, Client) {
                // models
                $scope.clientData = {} // Initialize the object
                // Sorting Table
                $scope.sortType     = 'id'; // set the default sort type
                $scope.sortReverse  = false;
                // get function from factory of the Client service
                Client.get().then(function(response) {
                    $scope.clients = response.data.client;
                    $scope.active_projects = response.data.active_projects;
                    console.log(response.data.active_projects);
                  });

                $scope.submitClient = function() {
                  Client.save($scope.clientData)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#clientCreate').modal('hide');
                            });
                            Client.get().then(function(response) {
                              $scope.clients = response.data.client;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.getClient = function(id) {
                  $http.get('{{ route('client-api.index') }}/'+id+'/edit').then(function(response) {
                    console.log(response.data.client);
                    $scope.clientData = response.data.client;
                  });
                };

                $scope.editClient = function(id) {
                  Client.update($scope.clientData, id)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#clientUpdate').modal('hide');
                            });
                            Client.get().then(function(response) {
                              $scope.clients = response.data.client;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.showClient = function(id) {
                  $http.get('{{ route('client-api.index') }}/'+id).then(function(response) {
                    $scope.clientData = response.data;
                  });
                }

                $scope.deleteClient = function(id) {
                  Client.destroy(id)
                          .then(function successCallback(response) {
                            Client.get().then(function(response) {
                              $scope.clients = response.data.client;
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
      var clientApp =
      angular.module('clientApp', [
                'mainCtrl',
                'clientService',
                'ngMaterial',
              ])
              .constant("CSRF_TOKEN", '{{ csrf_token() }}');


    </script>
@endsection
