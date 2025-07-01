@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <a href="{{ url('/') }}" class="btn btn-secondary mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-user-cog"></i> Edit Profil</h4>
            </div>
            <div class="card-body">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0"><i class="fas fa-key"></i> Ubah Password</h4>
            </div>
            <div class="card-body">
                @include('profile.partials.update-password-form')
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0"><i class="fas fa-trash"></i> Hapus Akun</h4>
            </div>
            <div class="card-body">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
