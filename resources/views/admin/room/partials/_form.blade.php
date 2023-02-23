<div class="form-group float-input">
    {!! Form::text('name', null, ['id' => 'name-input', 'class' => 'form-control', 'required' => true, 'autofocus' => true]) !!}
    {!! Form::label('name-input', __('validation.attributes.name')) !!}
</div>

<div class="form-group float-input">
    {!! Form::textarea('description', null, ['id' => 'description-input', 'class' => 'form-control', 'rows' => '2', 'required' => true]) !!}
    {!! Form::label('description-input', __('validation.attributes.description')) !!}
</div>

<div class="form-group float-input">
    {!! Form::text('limit', null, ['id' => 'limit-input', 'class' => 'form-control', 'required' => true]) !!}
    {!! Form::label('limit-input', __('validation.attributes.limit')) !!}
</div>

<div class="form-group d-flex align-items-center">
    {!! Form::checkbox('active', true, 0, ['id' => 'active-input']) !!}
    {!! Form::label('active-input', __('Activate on create?'), ['class' => 'm-0 mr-2']) !!}
</div>

<div class="d-flex align-items-center">
    <a class="btn btn-gray mr-2" type="submit" href="{{ route('admin.room.index') }}">{{ __('Back to list') }}</a>
    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
</div>