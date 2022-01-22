@extends('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('teachers.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Course Tests </h4>
                        <p class="card-description">
                            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#defaultModal">Create Question</button>

                        </p>
                       
                       
                        <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                            @foreach ($questions as $item)
                                
                           
                            <div class="card">
                              <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  {{$item->question}}
                                  </a>
                                </h5>
                              </div>
                              <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body">
                                    hui
                                <form action="/teacher/test/deletequestion/{{$item['id']}}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" id="testid" name="testid" value={{$testid}}>
                                    <button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button> 
                                </form>

                                </div>
                              </div>
                            </div>

                            @endforeach

                          </div>





                          <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Question for tests</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample" action="/teacher/test/createquestion" method="POST">
                                        @csrf

                                      <div class="form-group">
                                        <label for="exampleInputName1">Question</label>
                                        <textarea type="text" class="form-control" id="question" name="question" placeholder="Name"></textarea>
                                      </div>
                                     
                                      <div class="form-group">
                                        <label for="exampleInputName1">Answers</label>
                                        <input type="text" class="form-control" id="answers[]" name="answers[]" placeholder="Option 1">
                                        <input type="text" class="form-control" id="answers[]" name="answers[]" placeholder="Option 2">
                                        <input type="text" class="form-control" id="answers[]" name="answers[]" placeholder="Option 3">
                                        <input type="text" class="form-control" id="answers[]" name="answers[]" placeholder="Option 4">

                                      </div>

                                      <input type="hidden" class="form-control" id="testid" name="testid" value={{$testid}}>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Save changes</button> 
                                 </div>
                            </form>
                                </div>
                              </div>
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