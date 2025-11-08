@extends('layout/admin')
@section('body')
    <div class="card-footer small text mutter">
        <table class="table">
            <h3>Category</h3>
            <a href="" class="btn btn-primary">Add</a>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
      <th scope="col">Views </th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td><i class="fa-solid fa-eye text-info"></i></td>
      <td><i class="fa-solid fa-pen-to-square text-update"></i></td>
      <td><i class="fa-solid fa-trash text-delete"></i></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
      <td><i class="fa-solid fa-eye text-info"></i></td>
      <td><i class="fa-solid fa-pen-to-square text-update"></i></td>
      <td><i class="fa-solid fa-trash text-delete"></i></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
      <td><i class="fa-solid fa-eye text-info"></i></td>
      <td><i class="fa-solid fa-pen-to-square text-update"></i></td>
      <td><i class="fa-solid fa-trash text-delete"></i></td>
    </tr>
  </tbody>
</table>
    </div>
@endsection