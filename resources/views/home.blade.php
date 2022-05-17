<!DOCTYPE html>
<html lang="en">
<head>
  <title>fullstack-challenge</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>


</head>
<body>

<div class="container">
    <div>
        <br><br><br>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myModal"id="myBtn">Open new order</button>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                <h6 class="modal-title">New order</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="refera/registerOrder">

                            <div class="form-row">
                              <div class="form-group col-md-3">
                                <label for="inputName">Contact Name</label>
                                <input type="text" class="form-control" name="contactName" id="inputName" placeholder="Name">
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputPhone">Contact Phone</label>
                                <input type="text" class="form-control" name="contactPhone" id="inputPassword4" placeholder="Phone">
                              </div>
                              <div class="form-group col-md-3">
                                <label for="inputAgency">Real State Agency</label>
                                <input type="text" class="form-control" id="inputAgency" name="realState" placeholder="Agency">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputDescription">Order Description</label>
                                    <textarea rows="4" cols="40" name="description" maxlength="500"></textarea>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputCompany">Company</label>
                                    <input type="text" class="form-control" name="company" id="inputCompany" placeholder="Company">
                                </div>
                            </div>
                            <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="inputCategory">Select the order category</label><br>
                                        <select name="category" id="category">
                                            <option></option>
                                            @foreach ($category as $categorys )
                                                <option value={{ $categorys->id }} > {{ $categorys->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                              <div class="form-group col-md-3">
                                <label for="inputDeadline">Deadline</label>
                                <input type="date" name="deadline" class="form-control" id="inputDeadline">
                              </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>

            </div>
        </div>
    </div>
    <div>
        <!-- Fim Modal create -->
        <br>
        <!-- List order -->
    <table class="table table-striped table-bordered" class="display" id="example">
            <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Contact</th>
                <th>Agency</th>
                <th>Company</th>
                <th>Deadline</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)

                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->category }}</td>
                    <td>{{ $order->contactPhone }}</td>
                    <td>{{ $order->realState}}</td>
                    <td>{{ $order->company }}</td>
                    <td>{{ $order->deadline }}</td>
                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal{{ $order->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                      </svg>
                      Details
                    </button></i></td>
                </tr>

                <!-- Modal edit date -->
                <div class="modal fade" id="myModal{{ $order->id }}" role="dialog">
                    <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                        <h6 class="modal-title">Order Details</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="/action_page.php">

                                    <div class="form-row">
                                      <div class="form-group col-md-3">
                                        <label for="inputName">Contact Name</label>
                                        <input type="text" disabled="" value={{$order->contactName}} class="form-control" name="contactName" id="inputEmail4" placeholder="Name">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="inputPhone">Contact Phone</label>
                                        <input type="text" disabled="" class="form-control" disabled="" value={{ $order->contactPhone}} name="contactPhone" id="inputPassword4" placeholder="Phone">
                                      </div>
                                      <div class="form-group col-md-3">
                                        <label for="inputAgency">Real State Agency</label>
                                        <input type="text" disabled="" class="form-control" id="inputPassword4" name="realState" value={{ $order->realState}} placeholder="Agency">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputDescription">Order Description</label>
                                            <textarea rows="4" cols="40"  disabled="" name="description" maxlength="500">{{ $order->description}}</textarea>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputCompany">Company</label>
                                            <input type="text" disabled="" class="form-control" value={{ $order->company}} name="company" id="inputPassword4">
                                        </div>
                                    </div>
                                    <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="inputCategory">Category</label><br>
                                                <select name="category" id="category" disabled="">
                                                    <option >{{ $order->category }}</option>
                                                </select>

                                            </div>


                                      <div class="form-group col-md-3">
                                        <label for="inputDeadline">Deadline</label>
                                        <input type="date" disabled="" value={{ $order->deadline}} class="form-control" id="inputDeadline">
                                      </div>

                                    </div>

                            </form>
                        </div>

                    </div>

                    </div>
                </div>
                <!-- Fim Modal edit date -->
            @endforeach

                   </tbody>
        </table>
  </div>

</div>
<script>
    $(document).ready(function(){
      $('#example').DataTable({
        order: [[3, 'desc']],
      });

    });
    </script>

</body>

</html>
