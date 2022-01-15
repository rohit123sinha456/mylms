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
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Search Course Lessons</h4>
                        <p class="card-description">
                         
                          <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>
                                    Lesson Name
                                  </th>
                                  <th>
                                    Lesson Description
                                  </th>
                                  
                                  <th>
                                    Actions
                                  </th>
                                  <th>
                                    Status
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($courses as $item)
                                <tr>
                                  <td>
                                   {{$item['name']}}
                                  </td>
                                  
                                  <td>
                                      {{$item['id']}}
                                  </td>
                                  
                                  <td>
                                      <input type="hidden" name="courseid" id="courseid" value={{$item['id']}}>
                                      <div class="btn-group" role="group" aria-label="Basic example">
                                        <form action="/admin/lessons/view?courseid={{$item['id']}}" method="POST"> @csrf<button type="submit" class="btn btn-outline-secondary">View</button> </form>
                                        </div>
                                  </td>
                                  <td class="py-1">
                                    {{$item['status']}}
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






      
    