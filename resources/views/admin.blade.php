@extends('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Striped Table</h4>
                        <p class="card-description">
                          Add class <code>.table-striped</code>
                        </p>
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>
                                  User
                                </th>
                                <th>
                                  First name
                                </th>
                                <th>
                                  Progress
                                </th>
                                <th>
                                  Amount
                                </th>
                                <th>
                                  Deadline
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($teacher as $item)
                              <tr>
                                <td class="py-1">
                                  <img src="../../images/faces/face1.jpg" alt="image"/>
                                </td>
                                <td>
                                 {{$item->name}}
                                </td>
                                <td>
                                  <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                                <td>
                                    {{$item->email}}
                                </td>
                                <td>
                                  May 15, 2015
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>