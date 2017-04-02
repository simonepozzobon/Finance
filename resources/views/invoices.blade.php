@extends('layouts.main.index', ['page_active' => 'invoices'])
@section('title', 'Invoices')
@section('page-title', 'Invoices')
@section('stylesheets')
  <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css') }}">
  <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('content')
  <div class="clearfix" ng-app="invoiceApp" ng-controller="mainController" ng-cloak>
    <div class="row">
      <div class="col">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#invoiceCreate">
          Add New Invoice
        </button>

        <!-- Modal -->
        <div class="modal fade" id="invoiceCreate" tabindex="-1" role="dialog" aria-labelledby="invoiceCreateTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <form ng-submit="submitInvoice()" method="post">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="modal-header">
                  <h5 class="modal-title" id="invoiceCreateTitle">Add New Invoice</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" name="name" class="form-control" ng-model="invoiceData.name">
                    </div>
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" rows="8" class="form-control" ng-model="invoiceData.description">Description</textarea>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="start_date">Start Date</label>
                          <input id="start_date" type="text" name="start_date" class="form-control" ng-model="invoiceData.start_date">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="end_date">End Date</label>
                          <input id="end_date" type="text" name="end_date" class="form-control" ng-model="invoiceData.end_date">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="client_id">Client</label>
                      <input type="text" name="client_id" class="form-control" ng-model="invoiceData.client_id">
                    </div>
                    <div class="form-group">
                      <label for="status_id">Status</label>
                      <select class="form-control" name="status_id" ng-model="invoiceData.status_id">
                        <option ng-repeat="status in statuses" value="@{{ status.id }}" class="text-@{{ status.class }}">@{{ status.message }}</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Invoice</button>
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
            <tr ng-repeat="invoice in invoices | orderBy:sortType:sortReverse">
              <td class="align-middle">@{{ invoice.name }}</td>
              <td class="align-middle">@{{ invoice.start_date }}</td>
              <td class="align-middle">@{{ invoice.end_date }}</td>
              <td class="align-middle">@{{ invoice.client.name }}</td>
              <td class="align-middle"><span class="align-middle alert alert-@{{ invoice.status.class }}">@{{ invoice.status.message }}</span></td>
              <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                  {{-- View Modal Trigger --}}
                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#invoiceView" ng-click="showInvoice(invoice.id)">
                    View
                  </button>
                  {{-- View Modal --}}
                  <div class="modal fade" id="invoiceView" tabindex="-1" role="dialog" aria-labelledby="invoiceViewTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="invoiceViewTitle">Edit Invoice - Id: @{{ invoiceData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <h4>Name</h4>
                                @{{ invoiceData.name }}
                              </div>
                              <div class="form-group">
                                <h4>Description</h4>
                                @{{ invoiceData.description }}
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>Start Date</h4>
                                    @{{ invoiceData.start_date }}
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <h4>End Date</h4>
                                    @{{ invoiceData.end_date }}
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <h4 class="mb-4">Status</h4>
                                <span class="align-middle alert alert-@{{ invoiceData.status.class }}">@{{ invoiceData.status.message }}</span>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                    </div>
                  </div>
                  {{-- Edit Modal Trigger --}}
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#invoiceUpdate" ng-click="getInvoice(invoice.id)">
                    Edit
                  </button>
                  {{-- Edit Modal --}}
                  <div class="modal fade" id="invoiceUpdate" tabindex="-1" role="dialog" aria-labelledby="invoiceUpdateTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <form ng-submit="editInvoice(invoiceData.id)" method="post">
                          {{ csrf_field() }}
                          {{ method_field('post') }}
                          <div class="modal-header">
                            <h5 class="modal-title" id="invoiceUpdateTitle">Edit Invoice - Id: @{{ invoiceData.id }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" ng-model="invoiceData.name">
                              </div>
                              <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" class="form-control" ng-model="invoiceData.description">Description</textarea>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input id="start_date_edit" type="text" name="start_date" class="form-control" ng-model="invoiceData.start_date">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="end_date">End Date</label>
                                    <input id="end_date_edit" type="text" name="end_date" class="form-control" ng-model="invoiceData.end_date">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="client_id">Client</label>
                                <select class="form-control" name="client_id" ng-model="invoiceData.client_id">
                                  <option ng-repeat="client in clientsData" value="@{{ client.id }}">@{{ client.name }}</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="status_id">Status</label>
                                <select class="form-control" name="status_id" ng-model="invoiceData.status_id">
                                  <option ng-repeat="status in statusesData" value="@{{ status.id }}" class="text-@{{ status.class }}">@{{ status.message }}</option>
                                </select>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Invoice</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  {{-- Delete Button --}}
                  <a href="" ng-click="deleteInvoice(invoice.id)" class="btn btn-danger">Delete</a>
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
      angular.module('invoiceService', [])
              .factory('Invoice', function($http, CSRF_TOKEN){
                // Get all the category
                return {
                  get : function() {
                    return $http.get('{{ route('invoice-api.index') }}');
                  },

                  save : function(invoiceData) {
                    console.log($.param(invoiceData));
                      return $http({
                        method: 'POST',
                        url: '{{ route('invoice-api.store') }}',
                        data: $.param(invoiceData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  update : function(invoiceData, id) {
                    console.log($.param(invoiceData));
                      return $http({
                        method: 'PUT',
                        url: '{{ route('invoice-api.index') }}/'+id,
                        data: $.param(invoiceData),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                      });
                  },

                  destroy : function(id) {
                      return $http({
                        method: 'DELETE',
                        url: '{{ route('invoice-api.index') }}/'+id
                      });
                  }
                }
              });

      // Define the controller
      angular.module('mainCtrl', [])
              .controller('mainController', function($scope, $http, Invoice) {
                // models
                $scope.invoiceData = {} // Initialize the object
                // Sorting Table
                $scope.sortType     = 'id'; // set the default sort type
                $scope.sortReverse  = false;
                // get function from factory of the Invoice service
                Invoice.get().then(function(response) {
                    $scope.invoices = response.data.invoice;
                    $scope.statuses = response.data.status;
                    $scope.clients = response.data.client;
                  });

                $scope.submitInvoice = function() {
                  Invoice.save($scope.invoiceData)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#invoiceCreate').modal('hide');
                            });
                            Invoice.get().then(function(response) {
                              $scope.invoices = response.data.invoice;
                              $scope.statuses = response.data.status;
                              $scope.clients = response.data.client;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.getInvoice = function(id) {
                  $http.get('{{ route('invoice-api.index') }}/'+id+'/edit').then(function(response) {
                    console.log(response.data.status);
                    $scope.invoiceData = response.data.invoice;
                    $scope.statusesData = response.data.status;
                    $scope.clientsData = response.data.client;
                  });
                };

                $scope.editInvoice = function(id) {
                  Invoice.update($scope.invoiceData, id)
                          .then(function successCallback(response) {
                            jQuery(function() {
                              jQuery('#invoiceUpdate').modal('hide');
                            });
                            Invoice.get().then(function(response) {
                              $scope.invoices = response.data.invoice;
                            });
                          }, function errorCallback(response) {
                            console.log(response);
                          });
                };

                $scope.showInvoice = function(id) {
                  $http.get('{{ route('invoice-api.index') }}/'+id).then(function(response) {
                    $scope.invoiceData = response.data;
                  });
                }

                $scope.deleteInvoice = function(id) {
                  Invoice.destroy(id)
                          .then(function successCallback(response) {
                            Invoice.get().then(function(response) {
                              $scope.invoices = response.data.invoice;
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
      var invoiceApp =
      angular.module('invoiceApp', [
                'mainCtrl',
                'invoiceService',
                'ngMaterial',
              ])
              .constant("CSRF_TOKEN", '{{ csrf_token() }}');


    </script>
@endsection
