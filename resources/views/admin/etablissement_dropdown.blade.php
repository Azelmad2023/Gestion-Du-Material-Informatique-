<option value="">Select Etablissement</option>
@foreach($etablissements as $etablissement)
    <option value="{{ $etablissement->id }}">{{ $etablissement->name }}</option>
@endforeach
