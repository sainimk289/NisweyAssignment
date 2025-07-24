<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller {

    /**
     * 
     * @return type
     */
    public function import() {
        return view('contact.import');
    }

    /**
     * 
     * @return type
     */
    public function index() {
        $contacts = Contact::paginate(10);
        return view('contact.list', compact('contacts'));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function importContactsFromXml(Request $request) {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml,txt',
        ]);
        $file = $request->file('xml_file');
        if (!$file || !$file->isValid()) {
            return back()->withErrors(['xml_file' => 'No valid file uploaded.']);
        }
        try {
            $xmlContent = file_get_contents($file->getPathname());
            $xml = simplexml_load_string($xmlContent);
            if (!$xml) {
                return back()->withErrors(['xml_file' => 'Invalid XML format.']);
            }
            $imported = 0;
            $dumplicate = 0;
            foreach ($xml->contact as $contactNode) {
                if (isset($contactNode->phone) && isset($contactNode->name) && !empty($contactNode->phone) && !empty($contactNode->name)) {
                    $duplicate = Contact::where('phone', $contactNode->phone)->first();
                    if (!empty($duplicate)) {
                        $dumplicate++;
                        continue;
                    }
                    $contact = new Contact;
                    $contact->name = (string) $contactNode->name;
                    $contact->phone = (string) $contactNode->phone;
                    $contact->save();
                    $imported++;
                }
            }
            return redirect('/')->with('success', "$imported contacts imported successfully and $dumplicate duplicate contacts.");
        } catch (\Exception $e) {
            return back()->withErrors(['xml_file' => 'Error reading XML: ' . $e->getMessage()]);
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function edit($id) {
        $contact = Contact::where('id', $id)->first();
        return view('contact.edit', compact('contact'));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function update(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required',
        ]);
        try {
            $contact = Contact::where('id', $request->id)->first();
            if (!empty($contact)) {
                $contact->name = $request->name;
                $contact->phone = $request->phone;
                if ($contact->save()) {
                    return redirect('/')->with('success', "Contact detail updated successfully!");
                } else {
                    return back()->with("error", "Some thing went wrong, Please try after some times");
                }
            }
        } catch (\Exception $e) {
            return back()->with("error", "Some thing went wrong, Please try after some times");
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function delete($id) {
        try {
            $contact = Contact::where('id', $id)->first();
            if ($contact->delete()) {
                return redirect('/')->with('success', "Contact detail deleted successfully!");
            } else {
                return back()->with("error", "Some thing went wrong, Please try after some times");
            }
        } catch (\Exception $e) {
            return back()->with("error", "Some thing went wrong, Please try after some times");
        }
    }

}
