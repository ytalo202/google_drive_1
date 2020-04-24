<!-- Modal -->
<div class="modal fade" id="first-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" id="first-modal-size">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="first-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="first-modal-body">
            </div>
            <div class="modal-footer d-flex justify-content-center" id="first-modal-footer">
                {{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="second-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="second-modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="second-modal-body">
            </div>
            <div class="modal-footer d-flex justify-content-center" id="second-modal-footer">
                {{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

<script>
    function modalSize(modalId, size)
    {
        let id = document.getElementById(`${modalId}-size`)
        if(id){
            switch (size) {
                case 'lg': $(`#${modalId}-size`).attr('class', `modal-dialog modal-${size}`); break;
                case 'xl': $(`#${modalId}-size`).attr('class', `modal-dialog modal-${size}`); break;
                case 'sm': $(`#${modalId}-size`).attr('class', `modal-dialog modal-${size}`); break;
                default: $(`#${modalId}-size`).attr('class', `modal-dialog`);
            }
        }
    }

    function clearModal(id){
        let modal = document.getElementById(`${id}`)
        if(modal){
            $(`#${id}-title`).html(``)
            $(`#${id}-body`).html(``)
            $(`#${id}-footer`).html(``)
        }
    }
</script>
