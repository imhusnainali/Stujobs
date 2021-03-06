<!-- Modal -->
<div class="modal fade" id="modalEditCompany" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form name="editCompany" role="form" method="post" action="#">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Modifier une entreprise</h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <p class="statusMsg"></p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_email">Email de l'entreprise</label>*
                                <input type="text" class="form-control" id="edit_email" name="edit_email" required="required" placeholder="Ex : company@mail.com"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_role">Rôle</label>*
                                <select class="form-control" id="edit_role" name="edit_role" required="required">
                                    <option disabled selected value="">Sélectionner un rôle</option>
                                    <option value="company">Entreprise</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <p style="text-align:center;">Les informations suivantes ne sont pas obligatoire</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_name">Nom de l'entreprise</label>
                                <input type="text" class="form-control" id="edit_name" name="edit_name" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_siret">SIRET</label>
                                <input type="text" class="form-control" id="edit_siret" name="edit_siret" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_address">Adresse</label>
                                <input type="text" class="form-control" id="edit_address" name="edit_address" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit_phone">Téléphone</label>
                                <input type="text" class="form-control" id="edit_phone" name="edit_phone" />
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
            @endforeach

            <!-- Modal Footer -->
                <div class="modal-footer">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary submit-btn">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>