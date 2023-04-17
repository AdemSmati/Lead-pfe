<div>
    <button style="background-color: #0a53be;color: white;" type="button" class="btn m-4" data-toggle="modal" data-target="#store_lead">
        Ajouter lead
    </button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="store_lead" tabindex="-1" role="dialog" aria-labelledby="store_leadLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5  id="store_leadLabel">
                        Ajouter lead
                    </h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="storeLead">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Raison social</label>
                            <input type="text" wire:model.defer="lead.raison_social" class="form-control" id="exampleFormControlInput1" placeholder="Raison social">
                            @error('lead.raison_social') <span class="error">{{ $message }}</span> @enderror

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Selectionner etat</label>
                            <select wire:model.defer="lead.current_status" class="form-control" id="exampleFormControlSelect1">
                                @foreach($status as $s)
                                <option value="{{$s->id}}">{{$s->nom_status}}</option>
                                @endforeach
                            </select>
                            @error('lead.current_status') <span class="error">{{ $message }}</span> @enderror

                        </div>
                        <input  style="color: white;background-color: #0a53be" class="btn" type="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('close_modal', event => {
            console.log('test')
            $('#store_lead').hide();
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        })
    </script>
</div>
