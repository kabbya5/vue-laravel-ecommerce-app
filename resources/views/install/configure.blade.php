@extends('layouts.app')
@section('content')
    <div class="w:full md:w-96 mx-auto">
        <div class="bg-black">
            <form action="{{ route('install.configration.store') }}" method="POST" class="p-4">
                @csrf
                <div class="flex mb-3">
                    <label for="database" class="text-white"> database name: </label>
                    <input type="text" name='database' 
                    class="bg-transparent focus:outline-none focus:border-b-2
                    text-white px-3"> 
                </div>
                <div class="flex mb-5">
                    <label for="database_password" class="text-white"> database password: </label>
                    <input type="text" name='database_password' 
                    class="bg-transparent focus:outline-none focus:border-b-2
                    text-white px-3"> 
                </div>

                <button type="submit" class="text-center bg-whtie px-4 py-2 bg-white w-full">
                   Next
                </button>
                
            </form>
        </div>
    </div>
@endsection