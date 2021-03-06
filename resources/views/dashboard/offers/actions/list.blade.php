<table id="offers-content" class="table table-response table-bordered table-striped table-hover table-responsive-lg" style="width: 100%;">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Type de contrat</th>
        <th>Durée</th>
        <th>Rémunération</th>
        <th>Validée</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <td>{{ $offer->title ? $offer->title : 'NC' }}</td>
            <td>@lang('vocabulary.' . $offer->contract_type)</td>
            <td>{{ $offer->duration ? $offer->duration : 'NC'}}</td>
            <td>{{ $offer->remuneration ? $offer->remuneration : 'NC'}}</td>
            <td>
                @if ($offer->valid == 0)
                    <span class="badge badge-danger">Non</span>
                @else
                    <span class="badge badge-success">Oui</span>
                @endif
            </td>
            <td>
                @if ($offer->valid == 0)
                <button data-href="/dashboard/offers/{{ $offer->id }}/approve" class="btn btn-success btn-sm btn-pre-approve-offer" data-toggle="modal" data-target="#modalApproveOffer" style="margin-right: 30px;">
                    <i style="color: white;" class="fa fa-check"></i>
                </button>
                @else
                <button data-href="/dashboard/offers/{{ $offer->id }}/disapprove" class="btn btn-danger btn-sm btn-pre-disapprove-offer" data-toggle="modal" data-target="#modalDisapproveOffer" style="margin-right: 30px;">
                    <i style="color: white;" class="fa fa-times"></i>
                </button>
                @endif
                <a href="/dashboard/offers/{{ $offer->id }}/show" class="btn btn-primary btn-sm">
                    <i style="color: white;" class="fa fa-eye"></i>
                </a>
                <a href="/dashboard/offers/{{ $offer->id }}/edit" class="btn btn-warning btn-sm btn-pre-edit-offer">
                    <i style="color: white;" class="fa fa-pencil"></i>
                </a>
                <button data-href="/dashboard/offers/{{ $offer->id }}/delete" class="btn btn-danger btn-sm btn-pre-delete-offer" data-toggle="modal" data-target="#modalDeleteOffer">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>