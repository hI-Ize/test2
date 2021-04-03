@php


$contact_count = 0;

if (is_countable(old('contact_name'))){
    $contact_count = count(old('contact_name'));

    //dd($contact_count);
}


@endphp
@if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ $message }}</strong>

    </div>

@endif
<form method="post" action="/project">
    @csrf

    <div class="form-group">
        <label for="name">Name</label>
        <input value="{{old('name')}}" autofocus name="name" id="name" type="text" class="form-control" placeholder="Enter project's name">
        @error('name')
            <span class="contrast2 d-block" role="alert">
                <b class="text-danger">{{ $message }}</b>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="exampleFormControlTextarea1">Description</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('description')}}</textarea>
        @error('description')
        <span class="contrast2 d-block" role="alert">
                <b class="text-danger">{{ $message }}</b>
            </span>
        @enderror
    </div>


    <div class="form-group">
        <label for="pick-status">Status</label>
        <select name="status" class="form-control" id="pick-status">
            <option {{old('status') == 0 ? 'selected' : ''}} value="0">fejlesztésre vár</option>
            <option {{old('status') == 1 ? 'selected' : ''}} value="1">folyamatban</option>
            <option {{old('status') == 2 ? 'selected' : ''}} value="2">kész</option>
        </select>
    </div>

    <hr>
    <div id="before-contact-person" class="row">
        <h5 class="col-12">Contact Persons</h5>
    </div>



    @for($i=-1;$i<$contact_count;$i++)
        @php
        $email_value = '';
        $name_value = '';
        $name_key = '';
        $email_key = '';

        if ($i>-1){
            $email_value = old('contact_email')[$i];
            $name_value = old('contact_name')[$i];

            $name_key = 'contact_name.'.$i;
            $email_key = 'contact_email.'.$i;
        }

        @endphp
        <div class="row row-contact-person {{$i==-1 ? 'd-none' : ''}}">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="contact-name">Name</label>
                    <input value="{{$name_value}}" name="contact_name[]" id="contact-name" type="text" class="form-control" placeholder="Enter contact's name">

                    @error($name_key)
                    <span class="contrast2 d-block" role="alert">
                            <b class="text-danger">{{ $message }}</b>
                        </span>
                    @enderror

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input value="{{$email_value}}" name="contact_email[]" id="email" type="text" class="form-control" placeholder="Enter contact's email">

                    @error($email_key)
                        <span class="contrast2 d-block" role="alert">
                            <b class="text-danger">{{ $message }}</b>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-1 mt-auto">
                <div class="form-group">
                    <button class="btn btn-danger x-contact-person">x</button>

                </div>
            </div>
        </div>
    @endfor
    <div class="row">
        <div class="col-12">
            <button id="add-contact-person" class="btn btn-primary ">+</button>

        </div>
    </div>

    <hr>




    <button type="submit" class="btn btn-primary">Submit</button>
</form>