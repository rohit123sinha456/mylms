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
                        <h4 class="card-title">Courses </h4>
                        <p class="card-description">
                          Add class <code>.table-striped</code>
                        </p>
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>
                                  Course Name
                                </th>
                                
                                <th>
                                  Teacher
                                </th>
                                <th>
                                  Lessons
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
                              @foreach ($course as $item)
                              <tr>
                                <td>
                                 {{$item['name']}}
                                </td>
                                <td>
                                  {{$item['teacher']}}
                              </td>
                              <td>
                                <input type="hidden" name="courseid" id="courseid" value={{$item['id']}}>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                  <form action="/admin/lessons/view?courseid={{$item['id']}}" method="POST">@csrf <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                  <form action="/admin/lessons/create" method="GET"> @csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Create</button> </form>
                                </div>
                            </td>
                                <td>
                                    <input type="hidden" name="courseid" id="courseid" value={{$item['id']}}>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <form action="/admin/viewcourse/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                      <form action="/admin/editcourse/{{$item['id']}}" method="GET"> @csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button> </form>
                                      <form action="/admin/deletecourse?courseid={{$item['id']}}" method="POST">@csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button> </form>
                                      <form action="/admin/publishcourse?courseid={{$item['id']}}" method="POST">@csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Publish</button> </form>
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