@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Pregled prijava</div>

                <div class="panel-body">
                    
                    <h3>10 Random korisnika</h3>        
                    <table class="table table-striped">
                      <thead> 
                        <tr> 
                           <th>#</th> 
                           <th>First Name</th> 
                           <th>Last Name</th> 
                           <th>Email</th> 
                        </tr> 
                       </thead>
                       <tbody>
                           @foreach ($randomusers as  $index => $prijava)
                           <tr>
                              <td>{{$index+1}}</td>
                              <td>{{ $prijava->first_name }}</td>
                              <td>{{ $prijava->last_name }}</td>
                              <td>{{ $prijava->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3>Prijavljeni korisnici</h3>    
                    <h5>Ukupno prijava {{$ukupno}}</h5>
                    <table class="table table-striped">
                      <thead> 
                        <tr> 
                           <th>#</th> 
                           <th>First Name</th> 
                           <th>Last Name</th> 
                           <th>Email</th> 
                        </tr> 
                       </thead>
                       <tbody>
                           @foreach ($prijave as  $index => $prijava)
                           <tr>
                              <td>{{$index+1}}</td>
                              <td>{{ $prijava->first_name }}</td>
                              <td>{{ $prijava->last_name }}</td>
                              <td>{{ $prijava->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
