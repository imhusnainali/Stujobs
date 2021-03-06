/*
|--------------------------------------------------------------------------
| Alerts
|--------------------------------------------------------------------------
*/

// Global widget alert function
function alertWidget(div, message, type, duration) {
    $(div).fadeIn();
    $(div).html('<div class="alert '+ type +'" style="cursor:pointer;" onclick="closeAlert(this)">' + message + '</div>');
    setTimeout(function(){
        $(div).fadeOut();
    }, duration);
}

// Global widget alert close function
function closeAlert(div) {
    $(div).fadeOut();
}

/*
|--------------------------------------------------------------------------
| Offer approve
|--------------------------------------------------------------------------
*/

// Set approve button href
$(document).on('click', '.btn-pre-approve-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-approve-offer').attr('href', route);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalApproveOffer', function() {
    $(this).find('#btn-approve-offer').attr('href', '#');
});

$(document).on('click', '#btn-approve-offer', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> approuvée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        },
        complete: function() {
            $button.html($buttonValue);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Offer disapprove
|--------------------------------------------------------------------------
*/

// Set disapprove button href
$(document).on('click', '.btn-pre-disapprove-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-disapprove-offer').attr('href', route);
});

// Reset approve button href
$(document).on('hidden.bs.modal', '#modalDisapproveOffer', function() {
    $(this).find('#btn-disapprove-offer').attr('href', '#');
});

$(document).on('click', '#btn-disapprove-offer', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> désapprouvée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        },
        complete: function() {
            $button.html($buttonValue);
        }
    });
});

/*
|--------------------------------------------------------------------------
| Offer deletion
|--------------------------------------------------------------------------
*/

// Set delete button href
$(document).on('click', '.btn-pre-delete-offer', function(event) {
    event.preventDefault();
    var route = $(this).data('href');

    $('#btn-delete-offer').attr('href', route);
});

// Reset delete button href
$(document).on('hidden.bs.modal', '#modalDeleteOffer', function() {
    $(this).find('#btn-delete-offer').attr('href', '#');
});

$(document).on('click', '#btn-delete-offer', function(event) {
    event.preventDefault();

    var $modal = $(this).closest('.modal');
    var $button = $(this);
    var $buttonValue = $button.html();
    var url = $(this).attr('href');

    $.ajax({
        type: 'GET',
        url: url,
        beforeSend: function() {
            $button.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');
        },
        success: function(response) {
            alertWidget("#alerts" ,"L'offre a été <strong>correctement</strong> supprimée.", "alert-success", 4000);
            $button.html('<i class="fa fa-check"></i>');
            $("#offers-content").load(location.href + " #offers-content>*", "");
            $modal.modal('toggle');
        },
        error: function (response) {
            alertWidget("#alerts" ,"<strong>Une erreur est survenue.</strong> Merci de réessayer ultérieurement.", "alert-danger", 4000);
        },
        complete: function() {
            $button.html($buttonValue);
        }
    });
});