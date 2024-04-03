<!-- material_informatique_table.blade.php -->
<a href="{{ route('add_materail_form', ['id' => $etablissementId]) }}" class="btn btn-primary">Add</a>
<a href="{{ route('generate_pdf', ['etablissementId' => $etablissementId]) }}" class="btn btn-warning">Imprimer</a>

        <thead class="table-dark">
            <tr>
                <th>Inventory Number</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Acquisition Date</th>
                <th>End of Life</th>
                <th>State</th>
                <th>Action 1</th>
                <th>Action 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materielInformatiques as $materiel)
                <tr>
                    <td>{{ $materiel->Num_Inv }}</td>
                    <td>{{ $materiel->type }}</td>
                    <td>{{ $materiel->marque }}</td>
                    <td>{{ $materiel->dateDacquisition }}</td>
                    <td>{{ $materiel->EF }}</td>
                    <td>{{ $materiel->etat }}</td>
                    <td>
                        <a href="{{ route('edit_materiel', ['id' => $materiel->Num_Inv]) }}" class="btn btn-primary">Edit</a>
                    </td>
                        <td>
                        <form action="{{ route('delete_materiel', ['id' => $materiel->Num_Inv]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
