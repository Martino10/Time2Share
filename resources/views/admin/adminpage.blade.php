@extends('default')
@section('title')
   Admin Page
@endsection
@section('content')
    @include('layouts.navigation')
    <article>
        <section>
            <form action="{{ route('searchusers') }}" method="POST" role="search" class="usersearchbar">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search users">
                </div>
            </form>
        </section>
        <section>
            <ul class="user_list">

                @foreach($users as $user)
                    <li class="user_row">
                        <figure class="user_row__profilepic">
                            <img src="{{ $user->picture }}"/>
                        </figure>
                        <p class="user_row__username">{{ $user->username }}</p>

                        @if($user->blocked == 0)
                        <form id="blockform" class="blockform" action="{{ route('blockuser', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <button class="user_row__button user_row__button_block" type="submit" title="Stop this user's products from appearing">Block</button>
                        </form>

                        @else
                        <form id="unblockform" class="unblockform" action="{{ route('unblockuser', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <button class="user_row__button user_row__button_block" type="submit" title="Unblock this user's products">Unblock</button>
                        </form>
                        @endif

                        <form id="banform" class="banform" action="{{ route('banuser', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            <button class="user_row__button user_row__button_ban" type="submit" title="Delete this user from the database">Ban</button>
                        </form>
                    </li>

                @endforeach
            </ul>
        </section>
    </article>

    
@endsection