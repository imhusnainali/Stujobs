@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Éditer une annonce
                    </div>
                    <form name="editOffer" role="form" method="post" action="/dashboard/offers/{{ $offer->id }}/edit">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="select-company">
                                        <label for="edit_company_id">Entreprise</label>*
                                        <select class="form-control" id="edit_company_id" name="edit_company_id" required="required">
                                            <option disabled selected value="">Sélectionner une entreprise</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}" @if($offer->user_id == $company->id) selected @endif>{{ $company->email }} {{ $company->name ? '(' . $company->name . ')' : '(NC)' }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center">
                                    <p class="small">L'entreprise n'existe pas ?</p>
                                    <button type="button" data-destination="select-company" class="btn btn-primary btn-sm btn-pre-create-company" data-toggle="modal" data-target="#modalCreateCompany">
                                        Créer
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_title">Titre de l'annonce</label>*
                                        <input type="text" class="form-control" id="edit_title" name="edit_title" required="required" value="{{ $offer->title }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="edit_description">Description de l'annonce</label>*
                                        <textarea class="form-control" id="edit_description" name="edit_description" required="required" rows="5">{{ $offer->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_contract_type">Type de contrat</label>*
                                        <select class="form-control" id="edit_contract_type" name="edit_contract_type" required="required">
                                            <option disabled selected value="">Sélectionner un type de contrat</option>
                                            <?php
                                                $contracts = [
                                                    "nc" => "Non précisé",
                                                    "ctt" => "Intérim",
                                                    "sj" => "Job Étudiant",
                                                    "stage" => "Stage",
                                                    "ca" => "Contrat d'apprentissage",
                                                    "cp" => "Contrat de professionnalisation",
                                                    "cdd" => "CDD",
                                                    "cdi" => "CDI"
                                                ]
                                            ?>
                                            <?php foreach($contracts as $key => $contract): ?>
                                            <option value="<?= $key ?>" @if($offer->contract_type == $key) selected @endif><?= $contract ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_duration">Durée</label>*
                                        <input type="text" class="form-control" id="edit_duration" name="edit_duration" required="required" placeholder="Ex : 6 mois" value="{{ $offer->duration }}" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="edit_remuneration">Rémunération</label>* (taux horaire)
                                        <input type="text" class="form-control" id="edit_remuneration" name="edit_remuneration" required="required" value="{{ $offer->remuneration }}" placeholder="Ex : 10€/h" />
                                    </div>
                                </div>
                            </div>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        <div class="card-footer" style="text-align: right">
                            <input type="hidden" name="create_valid" id="edit_valid" value="{{ $offer->valid }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <a href="{{ route('dashboardIndexOffers') }}" type="button" class="btn btn-default" data-dismiss="modal" style="-webkit-appearance: initial; color:black">Annuler</a>
                            <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard/companies/actions/create')
@endsection
