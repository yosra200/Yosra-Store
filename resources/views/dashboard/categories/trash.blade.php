@extends('layouts.dashboard')
@section('title','Trashed categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "> categories</li>
    <li class="breadcrumb-item active"> Trash</li>

@endsection

@section('content')

 <div class="mb-5">
    <a href="{{Route('categories.index')}}" class="btn btn-sm btn-outline-primary">
    back
    </a>
 </div>

<x-alert></x-alert>

<form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4">
<x-form.input name="name"  placeholder="name"  class="mx-2" :value="request('name')"/>
<select name="status" class="form-control mx-2">
    <option value="">All</option>
    <option value="active" @selected(request('status') == 'active')>Active</option>
    <option value="archived" @selected(request('status') == 'archived')>Archived</option>

 </select>
    <button  class="btn btn-dark mx-2">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th>deleted At</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
            <td>{{ $category->id }}</td>
             <td><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td> 
            {{-- <td>{{ $category->products_number }}</td> --}}
            <td>{{ $category->status }}</td>
            <td>{{ $category->deleted_at}}</td>
            <td>
                <form action="{{ route('categories.restore', $category->id) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-outline-info">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('categories.force-delete', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No categories defined.</td>
        </tr>
        @endforelse
    </tbody>

</table>
 {{$categories->withQueryString()->links()}}
@endsection