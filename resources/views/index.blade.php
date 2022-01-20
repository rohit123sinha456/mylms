@extends('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Section Login</h4>
                  <p class="card-description">Add class <code>.btn-block</code></p>
                  <div class="template-demo">
                    <a type="button" href="/admin" class="btn btn-outline-secondary btn-lg btn-block">Admin Login</a>
                    <a type="button" href="/teacher" class="btn btn-outline-secondary btn-lg btn-block">Teacher Login</a>
                    <a type="button" href="/student" class="btn btn-outline-secondary btn-lg btn-block">Student Login</a>

                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
    </body>
</html>