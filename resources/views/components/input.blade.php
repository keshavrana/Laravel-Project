<div class="form-group">
    <label for="userName">{{$label}}<span class="text-danger">*</span></label>
    <input type="{{$type}}" name="{{$name}}" value="{{$value}}" parsley-trigger="change" required placeholder="{{$label}}"
        class="form-control" id="userName">
</div>