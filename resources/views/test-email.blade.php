@extends('layouts.app')

@section('title', 'Test Email System - EHCO BTP')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>🔧 Test du Système d'Email</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('test.email.send') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de test :</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="simple">Email simple</option>
                                <option value="contact">Email ContactMessage</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destinataire" class="form-label">Destinataire :</label>
                            <input type="email" name="destinataire" id="destinataire" 
                                   class="form-control" value="kavegeamelie@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="sujet" class="form-label">Sujet :</label>
                            <input type="text" name="sujet" id="sujet" 
                                   class="form-control" value="Test Email - {{ now()->format('Y-m-d H:i:s') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            📧 Envoyer Test Email
                        </button>
                    </form>

                    <hr class="my-4">

                    <h5>📋 Configuration actuelle :</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>MAIL_MAILER:</strong> {{ config('mail.default') }}</li>
                        <li class="list-group-item"><strong>MAIL_HOST:</strong> {{ config('mail.mailers.smtp.host') }}</li>
                        <li class="list-group-item"><strong>MAIL_PORT:</strong> {{ config('mail.mailers.smtp.port') }}</li>
                        <li class="list-group-item"><strong>MAIL_USERNAME:</strong> {{ config('mail.mailers.smtp.username') }}</li>
                        <li class="list-group-item"><strong>MAIL_ENCRYPTION:</strong> {{ config('mail.mailers.smtp.encryption') }}</li>
                        <li class="list-group-item"><strong>MAIL_FROM_ADDRESS:</strong> {{ config('mail.from.address') }}</li>
                        <li class="list-group-item"><strong>MAIL_FROM_NAME:</strong> {{ config('mail.from.name') }}</li>
                    </ul>

                    <hr class="my-4">

                    <h5>🔍 Informations système :</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>PHP Version:</strong> {{ phpversion() }}</li>
                        <li class="list-group-item"><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                        <li class="list-group-item"><strong>Environment:</strong> {{ app()->environment() }}</li>
                        <li class="list-group-item"><strong>Date/Heure:</strong> {{ now()->format('Y-m-d H:i:s') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
