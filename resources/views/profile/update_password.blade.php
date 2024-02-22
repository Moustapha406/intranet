<div class="modal fade" id="user_{{$user->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 >Modifier votre mot de passe</h5>
            
            </div>
        <form method="post" action="{{ route('profile.updatePassword') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
            
            <div class="modal-body">
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Nouveau mot de passe</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="password" name="password" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-sm-4 col-form-label">Comfirmer le mot de passe</label>
                    <div class="col-sm-8">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="submit" class="btn btn-primary" >Modifier</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
        </div>
    </div>
</div>