
namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class PegawaiController extends Controller
{
    public function index(): View
    {
        try {
            $pegawai = Pegawai::latest()->paginate(10);
            return view('pegawai.index', compact('pegawai'));
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Error retrieving data from database.']);
        }
    }

    public function create(): View
    {
        return view('pegawai.create');
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama'    => 'required|min:2',
                'jabatan' => 'required',
                'alamat' => 'nullable',
                'jenis_kelamin' => 'nullable',
                'status' => 'nullable',
            ]);

            Pegawai::create($request->all());

            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Error storing data to database.']);
        }
    }

    public function show(string $id): View
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            return view('pegawai.show', compact('pegawai'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Pegawai tidak ditemukan!']);
        }
    }

    public function edit(string $id): View
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            return view('pegawai.edit', compact('pegawai'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Pegawai tidak ditemukan!']);
        }
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'nama'    => 'required|min:2',
                'jabatan' => 'required',
                'alamat' => 'nullable',
                'jenis_kelamin' => 'nullable',
                'status' => 'nullable',
            ]);

            $pegawai = Pegawai::findOrFail($id);
            $pegawai->update($request->all());

            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Pegawai tidak ditemukan!']);
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Error updating data to database.']);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Pegawai tidak ditemukan!']);
        } catch (\Exception $e) {
            return redirect()->route('pegawai.index')->with(['error' => 'Error deleting data from database.']);
        }
    }
}
