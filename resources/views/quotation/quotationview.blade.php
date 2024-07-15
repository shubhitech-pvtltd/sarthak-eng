<!DOCTYPE html>
<html>

<head>
    <title>Quotation Letter</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .page {
        position: relative;
        page-break-after: always;
        padding: 20px;
        height: 1000px;
        box-sizing: border-box;
        margin-left: 50px;
        margin-right: 40px;
    }

    .header {
        text-align: center;
        top: 0;
    }

    .footer {
        text-align: left;
        position: absolute;
        bottom: 0;
        font-size: 0.9em;
        color: #777;
        width: 100%;
    }

    .header img {
        max-width: 150px;
    }

    .header h1 {
        font-size: 36px;
        color: #0066cc;
    }

    .header p {
        margin: 5px 0;
    }

    .content {
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .btn-container {
        text-align: center;
        margin: 20px 0;
    }

    .edit-btn a {
        background-color: #ffc107;
        color: #000;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .edit-btn a:hover {
        background-color: #e0a800;
    }

    .download-btn button {
        background-color: #0066cc;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .download-btn button:hover {
        background-color: #004080;
    }

    .back-btn a {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn a:hover {
        background-color: #218838;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        word-wrap: break-word;
        word-break: break-word;
    }

    th {
        background-color: #f2f2f2;
    }

    .yellow th,
    .yellow td {
        background-color: yellow;

    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
</head>

<body>
    <div class="page">
        <div class="header" style="display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" style="width: 100px; height: auto;">
            <div style="margin-center: 50px;">
                <h1>Sarthak Engineering</h1>
                <strong>Works : Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India</strong>
            </div>
        </div>
        <br><br>
        <div class="content" style="text-align: justify;">
            <p style="display: flex; justify-content: space-between;"><strong>Quotation Ref No.
                    SE/{{$quotation->id}}/2023-24 (REVISED)</strong>
                <strong>Date: {{ $quotation->date ?? 'N/A' }}</strong>
            </p>


            <p style="border: 1px solid black; border-radius: 10px; padding: 10px; width:40%; text-align: justify;">
                <strong>To:
                    {{ $quotation->client->company_name ?? 'N/A' }}</strong><br><br>
                <strong>Address: {{ $quotation->client->company_address_1 ?? 'N/A' }}
                    {{ $quotation->client->company_address_2 ?? 'N/A' }} {{ $quotation->client->city ?? 'N/A' }}
                    <br>
                    {{ $quotation->client->state ?? 'N/A' }} {{ $quotation->client->pincode ?? 'N/A' }}
                </strong>
            </p>
            <p style="border: 1px solid black; border-radius: 10px; padding: 10px; width:40%; text-align: justify;">
                <strong>From: SARTHAK
                    ENGINEERING</strong><br>
                Khesra no. 69-19/3, Jhundpur,
                <br> Sonipat, HR-131021
            </p>
            <p><strong>Sub: Offer for {{$quotation->title}}.</strong></p>
            <strong>Dear Sir,</strong>
            <p>I would like to use this opportunity to introduce you to Sarthak Engineering, seller of Reconditioned Gea
                Westfalia Separator. We own an office and factory at Kundli Industrial area, Sonipat. Sarthak
                Engineering has been started keeping in view customer’s demand for used/reconditioned machinery. Since
                the beginning we are involved in selling and servicing of reconditioned separators as well as new
                separators for Dairy, Edible oil, Pharma and other various industries. We stock a wide range of
                machineries of Gea Westfalia and Alfa laval make sourced worldwide. We provide all spare parts required
                for periodic servicing of machine as well as repairing.</p>
            <p>Thank you for your valuable enquiry. It is our pleasure for offering you the following machines and
                enclosing herewith our detailed quotations for the same along with our terms and conditions of sale.</p>
            <p>So, we request you to find the attached quotation no. SE/{{$quotation->id}}/2023-24.</p>
        </div>
        <div class="footer">
            <strong>Sarthak Engineering</strong><br>
            <strong>Works:</strong> Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India.<br>
            <strong> Tel.</strong> +91 8814956109,<strong> E-Mail:</strong> sales@sarthakengineering.com<br>
            <strong>GST No. 06APPPK0166Q1Z4 PAN No.: APPPK0166Q</strong></p>
        </div>
    </div>

    <div class="page">
        <div class="header" style="display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" style="width: 100px; height: auto;">
            <div style="margin-center: 50px;">
                <h1>Sarthak Engineering</h1>
                <strong>Works: Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India</strong>
            </div>
        </div>
        <h2>SUBJECT : Offer for {{$machine->machine_name}} {{$machine->model_no}}</h2>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>PART NO.</th>
                        <th>DESCRIPTION</th>
                        <th>QTY</th>
                        <th>UNITS</th>
                        <th>PRICE IN {{$quotation->client->currency ?? 'RS.'}}</th>
                        <th>TOTAL PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quotation->quotationlists as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->part->part_no ?? 'N/A' }}</td>
                        <td>{{ $item->part->description ?? 'N/A' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->price - $item->discount }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6" class="text-right"><strong>TOTAL AMOUNT IN
                                {{$quotation->client->currency ?? 'RS.'}}</strong></td>
                        <td><strong>{{ $quotation->grand_total }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <strong>Sarthak Engineering</strong><br>
            <strong>Works:</strong> Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India.<br>
            <strong> Tel.</strong> +91 8814956109,<strong> E-Mail:</strong> sales@sarthakengineering.com<br>
            <strong>GST No. 06APPPK0166Q1Z4 PAN No.: APPPK0166Q</strong></p>
        </div>
    </div>

    <div class="page">
        <div class="header" style="display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" style="width: 100px; height: auto;">
            <div style="margin-center: 50px;">
                <h1>Sarthak Engineering</h1>
                <strong>Works: Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India</strong>
            </div>
        </div>
        <div class="content" style="text-align: justify;">

            <h3 style="text-decoration: underline;">Terms & Conditions of Sale:</h3>
            <p><strong>1. Commercial Conditions</strong></p>
            <p>Our offer is based upon acceptance of the following commercial terms and conditions:</p>
            <br>
            <h3 style="text-decoration: underline;">PRICE</h3>
            <p>The quoted prices are for the basic machine and ex-works, Sonipat, Haryana.</p>
            <p style="text-decoration: underline;"><strong>Extra Charges that will be in your scope:</strong></p>
            <p>Freight Charges will be charged extra.</p>
            <p>Packing Charges will be charged extra.</p>
            <p>GST 18%</p>
            <br>
            <p><strong>2. Payment Conditions</strong></p>
            <p>The price shall be paid as follows: </p>
            <p>100% advance against PI before dispatch.</p>
            <br>
            <p><strong>3. Delivery Conditions</strong></p>
            <p>Within 1-2 weeks from the date of confirmed order.</p>
            <br>
            <p><strong>4. Validity of Quotation</strong></p>
            <p>The offer will be remained valid for 1 month.</p>

        </div>
        <div class="footer">
            <strong>Sarthak Engineering</strong><br>
            <strong>Works:</strong> Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India.<br>
            <strong> Tel.</strong> +91 8814956109,<strong> E-Mail:</strong> sales@sarthakengineering.com<br>
            <strong>GST No. 06APPPK0166Q1Z4 PAN No.: APPPK0166Q</strong></p>
        </div>
    </div>

    <div class="page">
        <div class="header" style="display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Company Logo" style="width: 100px; height: auto;">
            <div style="margin-center: 50px;">
                <h1>Sarthak Engineering</h1>
                <strong>Works: Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India</strong>
            </div>
        </div>
        <br>
        <div class="content" style="text-align: justify;">
            <h3 style="text-decoration: underline;">5. Ordering Information</h3>
            <p>Please issue the purchase order in favor of –</p>
            <br>
            <p>Sarthak Engineering<br>
                Khesra No.69-19/3, Jhundpur, Sonipat, HR-131021<br>
                GSTIN: 06APPPK0166Q1Z4<br>
                Email Id: sales@sarthakengineering.com<br>
                Contact No. 8814956109</p>
            <p>NOTES: For more details visit our website <a
                    href="http://www.sarthakengineering.com">www.sarthakengineering.com</a></p>
            <table>
                <tbody>
                    <tr class="yellow">
                        <th>Bank Name</th>
                        <td>ICICI BANK</td>
                    </tr>
                    <tr>
                        <th>Name in Bank</th>
                        <td>SARTHAK ENGINEERING</td>
                    </tr>
                    <tr>
                        <th>Account No.</th>
                        <td>140505500532</td>
                    </tr>
                    <tr>
                        <th>Bank Branch</th>
                        <td>KUNDLI, SONIPAT</td>
                    </tr>
                    <tr>
                        <th>IFSC Code</th>
                        <td>ICIC0001405</td>
                    </tr>
                    <tr>
                        <th>SWIFT Code</th>
                        <td>ICICINBBCTS</td>
                    </tr>
                </tbody>
            </table>
            <h3 style="text-decoration: underline;">Contact Information</h3>
            <p>For any queries regarding this quotation, please contact us at:</p>
            <p>Email: sales@sarthakengineering.com<br>
                Phone: +91 8814956109<br>
                Website: <a href="http://www.sarthakengineering.com">www.sarthakengineering.com</a></p>
        </div>
        <div class="footer">
            <strong>Sarthak Engineering</strong><br>
            <strong>Works:</strong> Khesra No.69-19/3, Jhundpur, Sonipat -131021, (HR), India.<br>
            <strong> Tel.</strong> +91 8814956109,<strong> E-Mail:</strong> sales@sarthakengineering.com<br>
            <strong>GST No. 06APPPK0166Q1Z4 PAN No.: APPPK0166Q</strong></p>
        </div>
    </div>
    <div class="btn-container">
        <span class="edit-btn">
            <a href="{{ url('/quotation/' . $quotation->id . '/edit') }}">
                <i class="fa fa-pencil"></i> Edit
            </a>
        </span>

        <span class="download-btn">
            <button onclick="downloadPDF()">Download as PDF</button>
        </span>

        <span class="back-btn">
            <a href="{{ url('/quotation')}}" class="btn">Back</a>
        </span>
    </div>


    <script>
    function downloadPDF() {
        document.querySelectorAll('.btn-container').forEach(btn => btn.style.display = 'none');
        const element = document.body;
        html2pdf().from(element).set({
            filename: 'quotation.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        }).toPdf().get('pdf').then(function(pdf) {
            var totalPages = pdf.internal.getNumberOfPages();
            for (var i = 1; i <= totalPages; i++) {
                pdf.setPage(i);
                pdf.setFontSize(10);
                pdf.text('Page ' + i + ' of ' + totalPages, pdf.internal.pageSize.getWidth() - 20, pdf.internal
                    .pageSize.getHeight() - 10);
            }
        }).save().then(() => {
            document.querySelectorAll('.btn-container').forEach(btn => btn.style.display = 'block');
        });
    }
    </script>
</body>

</html>