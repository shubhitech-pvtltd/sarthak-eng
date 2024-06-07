@extends('layout.main')

@section('main-section')


<div class="main-container m-5">
    <div class="clearfix">
        <div class="pull-left">
            <h2>{{isset($client) ? "Edit" : "Create"}} Client</h2>
        </div>
        <ol class="breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Client</li>
            <li class="breadcrumb-item active textChng">{{isset($client) ? "Edit" : "Create"}} Client</li>
        </ol>
    </div>

    <div class="pd-20 bg-white border-radius-4 box-shadow">

    <div class="col-md-12">
    <form action="{{isset($client) ? url('/client/'.$client->id) : url('/client')}}" method="post">

        
        <!-- CSRF Token -->
        @csrf

        {{-- Method PUT for Update --}}
        @isset($client)
           @method('PUT')    
        @endisset

        <h5 class="text-primary">Owner Details</h5>

        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Name<span class="text-danger">*</span></label>
                <input type="text" name="owner_name" value="{{isset($client) ? $client->owner_name : ''}}" class="form-control" placeholder="Enter Owner Name">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Email<span class="text-danger">*</span></label>
                <input type="owner_email" name="owner_email" value="{{isset($client) ? $client->owner_email : ''}}" class="form-control" placeholder="Enter Owner Email ">
            </div>
        </div> 
        
        <div class="form-group row">
        <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Phone No.<span class="text-danger">*</span></label>
                <input type="owner_phone_no" name="owner_phone_no" value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control" placeholder="Enter Owner Phone No. ">
            </div>
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Owner Aadhar Card No.<span class="text-danger"></span></label>
                <input type="owner_aadhar_no " name="owner_aadhar_no" value="{{isset($client) ? $client->owner_phone_no : ''}}" class="form-control" placeholder="Enter Owner Aadhar No.">
            </div>
        </div> 
        <!-- <div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Owner Address<span class="text-danger"></span></label>
            <textarea class="form-control" name="owner_address"cols="6" rows="1"  value="{{isset($client) ? $client->owner_address : '' }}" class="form-control" id="address" placeholder="Address"></textarea>
            </div>
        </div>    -->

        <hr>
        <h5 class="text-primary mt-4">Company Details</h5>
        
        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Company Name<span class="text-danger">*</span></label>
                <input type="text" name="company_name" value="{{isset($client) ? $client->company_name : ''}}" required class="form-control" placeholder="Enter Company Name">
            </div> 
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label">Company Email ID<span class="text-danger">*</span></label>
                <input type="text" name="company_email" value="{{isset($client) ? $client->company_email : ''}}"  class="form-control" placeholder="Enter  Company Email Id">
            </div> 
        </div>

        <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label ">Company Phone No.<span class="text-danger"></span></label>
                <input type="company_phone_no" name="company_phone_no" value="{{isset($client) ? $client->company_phone_no : ''}}" class="form-control" placeholder="Enter Company Phone No. ">
            </div>
           
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Company PAN No.<span class="text-danger"></span></label>
                <input type="integer" name="company_pan_no" required value="{{isset($client) ? $client->company_pan_no : ''}}" class="form-control" id="mobile" placeholder="Enter Company PAN No." >
            </div>
      </div>  
      <div class="form-group row">
            <div class="col-sm-6 fw-bold">
                <label class="col-form-label ">Company GST No.<span class="text-danger"></span></label>
                <input type="company_gst_no" name="company_gst_no"  value="{{isset($client) ? $client->company_gst_no : ''}}" class="form-control" placeholder="Enter Company GST No. ">
            </div>
           
            <div class="col-sm-6">
                <label class="col-form-label fw-bold">Company CIN No./ Licenss No.<span class="text-danger"></span></label>
                <input type="integer" name="company_cin_no"  value="{{isset($client) ? $client->company_cin_no : ''}}" class="form-control" id="mobile" placeholder="Enter Company CIN No." >
            </div>
      </div>  

      <div class="form-group row">
      <!-- <div class="col-sm-6  fw-bold"> -->
        <label class="col-form-label fw-bold">Country<span class="text-danger">*</span></label>
         <select class="js-example-basic-single" name="country"   value="{{isset($client) ? $client->country : ''}}">
          <option disabled selected>Select A Country</option>
    <option value="AFG" {{ isset($client) && $client->country == "AFG" ? "selected" : "" }}>Afghanistan</option>
    <option value="ALB" {{ isset($client) && $client->country == "ALB" ? "selected" : "" }}>Albania</option>
    <option value="DZA" {{ isset($client) && $client->country == "DZA" ? "selected" : "" }}>Algeria</option>
    <option value="AND" {{ isset($client) && $client->country == "AND" ? "selected" : "" }}>Andorra</option>
    <option value="AGO" {{ isset($client) && $client->country == "AGO" ? "selected" : "" }}>Angola</option>
    <option value="ATG" {{ isset($client) && $client->country == "ATG" ? "selected" : "" }}>Antigua and Barbuda</option>
    <option value="ARG" {{ isset($client) && $client->country == "ARG" ? "selected" : "" }}>Argentina</option>
    <option value="ARM" {{ isset($client) && $client->country == "ARM" ? "selected" : "" }}>Armenia</option>
    <option value="AUS" {{ isset($client) && $client->country == "AUS" ? "selected" : "" }}>Australia</option>
    <option value="AUT" {{ isset($client) && $client->country == "AUT" ? "selected" : "" }}>Austria</option>
    <option value="AZE" {{ isset($client) && $client->country == "AZE" ? "selected" : "" }}>Azerbaijan</option>
    <option value="BHS" {{ isset($client) && $client->country == "BHS" ? "selected" : "" }}>Bahamas</option>
    <option value="BHR" {{ isset($client) && $client->country == "BHR" ? "selected" : "" }}>Bahrain</option>
    <option value="BGD" {{ isset($client) && $client->country == "BGD" ? "selected" : "" }}>Bangladesh</option>
    <option value="BRB" {{ isset($client) && $client->country == "BRB" ? "selected" : "" }}>Barbados</option>
    <option value="BLR" {{ isset($client) && $client->country == "BLR" ? "selected" : "" }}>Belarus</option>
    <option value="BEL" {{ isset($client) && $client->country == "BEL" ? "selected" : "" }}>Belgium</option>
    <option value="BLZ" {{ isset($client) && $client->country == "BLZ" ? "selected" : "" }}>Belize</option>
    <option value="BEN" {{ isset($client) && $client->country == "BEN" ? "selected" : "" }}>Benin</option>
    <option value="BTN" {{ isset($client) && $client->country == "BTN" ? "selected" : "" }}>Bhutan</option>
    <option value="BOL" {{ isset($client) && $client->country == "BOL" ? "selected" : "" }}>Bolivia</option>
    <option value="BIH" {{ isset($client) && $client->country == "BIH" ? "selected" : "" }}>Bosnia and Herzegovina</option>
    <option value="BWA" {{ isset($client) && $client->country == "BWA" ? "selected" : "" }}>Botswana</option>
    <option value="BRA" {{ isset($client) && $client->country == "BRA" ? "selected" : "" }}>Brazil</option>
    <option value="BRN" {{ isset($client) && $client->country == "BRN" ? "selected" : "" }}>Brunei</option>
    <option value="BGR" {{ isset($client) && $client->country == "BGR" ? "selected" : "" }}>Bulgaria</option>
    <option value="BFA" {{ isset($client) && $client->country == "BFA" ? "selected" : "" }}>Burkina Faso</option>
    <option value="BDI" {{ isset($client) && $client->country == "BDI" ? "selected" : "" }}>Burundi</option>
    <option value="CPV" {{ isset($client) && $client->country == "CPV" ? "selected" : "" }}>Cabo Verde</option>
    <option value="KHM" {{ isset($client) && $client->country == "KHM" ? "selected" : "" }}>Cambodia</option>
    <option value="CMR" {{ isset($client) && $client->country == "CMR" ? "selected" : "" }}>Cameroon</option>
    <option value="CAN" {{ isset($client) && $client->country == "CAN" ? "selected" : "" }}>Canada</option>
    <option value="CAF" {{ isset($client) && $client->country == "CAF" ? "selected" : "" }}>Central African Republic</option>
    <option value="TCD" {{ isset($client) && $client->country == "TCD" ? "selected" : "" }}>Chad</option>
    <option value="CHL" {{ isset($client) && $client->country == "CHL" ? "selected" : "" }}>Chile</option>
    <option value="CHN" {{ isset($client) && $client->country == "CHN" ? "selected" : "" }}>China</option>
    <option value="COL" {{ isset($client) && $client->country == "COL" ? "selected" : "" }}>Colombia</option>
    <option value="COM" {{ isset($client) && $client->country == "COM" ? "selected" : "" }}>Comoros</option>
    <option value="COG" {{ isset($client) && $client->country == "COG" ? "selected" : "" }}>Congo (Congo-Brazzaville)</option>
    <option value="CRI" {{ isset($client) && $client->country == "CRI" ? "selected" : "" }}>Costa Rica</option>
    <option value="HRV" {{ isset($client) && $client->country == "HRV" ? "selected" : "" }}>Croatia</option>
    <option value="CUB" {{ isset($client) && $client->country == "CUB" ? "selected" : "" }}>Cuba</option>
    <option value="CYP" {{ isset($client) && $client->country == "CYP" ? "selected" : "" }}>Cyprus</option>
    <option value="CZE" {{ isset($client) && $client->country == "CZE" ? "selected" : "" }}>Czechia (Czech Republic)</option>
    <option value="COD" {{ isset($client) && $client->country == "COD" ? "selected" : "" }}>Democratic Republic of the Congo</option>
    <option value="DNK" {{ isset($client) && $client->country == "DNK" ? "selected" : "" }}>Denmark</option>
    <option value="DJI" {{ isset($client) && $client->country == "DJI" ? "selected" : "" }}>Djibouti</option>
    <option value="DMA" {{ isset($client) && $client->country == "DMA" ? "selected" : "" }}>Dominica</option>
    <option value="DOM" {{ isset($client) && $client->country == "DOM" ? "selected" : "" }}>Dominican Republic</option>
    <option value="ECU" {{ isset($client) && $client->country == "ECU" ? "selected" : "" }}>Ecuador</option>
    <option value="EGY" {{ isset($client) && $client->country == "EGY" ? "selected" : "" }}>Egypt</option>
    <option value="SLV" {{ isset($client) && $client->country == "SLV" ? "selected" : "" }}>El Salvador</option>
    <option value="GNQ" {{ isset($client) && $client->country == "GNQ" ? "selected" : "" }}>Equatorial Guinea</option>
    <option value="ERI" {{ isset($client) && $client->country == "ERI" ? "selected" : "" }}>Eritrea</option>
    <option value="EST" {{ isset($client) && $client->country == "EST" ? "selected" : "" }}>Estonia</option>
    <option value="SWZ" {{ isset($client) && $client->country == "SWZ" ? "selected" : "" }}>Eswatini</option>
    <option value="ETH" {{ isset($client) && $client->country == "ETH" ? "selected" : "" }}>Ethiopia</option>
    <option value="FJI" {{ isset($client) && $client->country == "FJI" ? "selected" : "" }}>Fiji</option>
    <option value="FIN" {{ isset($client) && $client->country == "FIN" ? "selected" : "" }}>Finland</option>
    <option value="FRA" {{ isset($client) && $client->country == "FRA" ? "selected" : "" }}>France</option>
    <option value="GAB" {{ isset($client) && $client->country == "GAB" ? "selected" : "" }}>Gabon</option>
    <option value="GMB" {{ isset($client) && $client->country == "GMB" ? "selected" : "" }}>Gambia</option>
    <option value="GEO" {{ isset($client) && $client->country == "GEO" ? "selected" : "" }}>Georgia</option>
    <option value="DEU" {{ isset($client) && $client->country == "DEU" ? "selected" : "" }}>Germany</option>
    <option value="GHA" {{ isset($client) && $client->country == "GHA" ? "selected" : "" }}>Ghana</option>
    <option value="GRC" {{ isset($client) && $client->country == "GRC" ? "selected" : "" }}>Greece</option>
    <option value="GRD" {{ isset($client) && $client->country == "GRD" ? "selected" : "" }}>Grenada</option>
    <option value="GTM" {{ isset($client) && $client->country == "GTM" ? "selected" : "" }}>Guatemala</option>
    <option value="GIN" {{ isset($client) && $client->country == "GIN" ? "selected" : "" }}>Guinea</option>
    <option value="GNB" {{ isset($client) && $client->country == "GNB" ? "selected" : "" }}>Guinea-Bissau</option>
    <option value="GUY" {{ isset($client) && $client->country == "GUY" ? "selected" : "" }}>Guyana</option>
    <option value="HTI" {{ isset($client) && $client->country == "HTI" ? "selected" : "" }}>Haiti</option>
    <option value="HND" {{ isset($client) && $client->country == "HND" ? "selected" : "" }}>Honduras</option>
    <option value="HUN" {{ isset($client) && $client->country == "HUN" ? "selected" : "" }}>Hungary</option>
    <option value="ISL" {{ isset($client) && $client->country == "ISL" ? "selected" : "" }}>Iceland</option>
    <option value="IND" {{ isset($client) && $client->country == "IND" ? "selected" : "" }}>India</option>
    <option value="IDN" {{ isset($client) && $client->country == "IDN" ? "selected" : "" }}>Indonesia</option>
    <option value="IRN" {{ isset($client) && $client->country == "IRN" ? "selected" : "" }}>Iran</option>
    <option value="IRQ" {{ isset($client) && $client->country == "IRQ" ? "selected" : "" }}>Iraq</option>
    <option value="IRL" {{ isset($client) && $client->country == "IRL" ? "selected" : "" }}>Ireland</option>
    <option value="ISR" {{ isset($client) && $client->country == "ISR" ? "selected" : "" }}>Israel</option>
    <option value="ITA" {{ isset($client) && $client->country == "ITA" ? "selected" : "" }}>Italy</option>
    <option value="JAM" {{ isset($client) && $client->country == "JAM" ? "selected" : "" }}>Jamaica</option>
    <option value="JPN" {{ isset($client) && $client->country == "JPN" ? "selected" : "" }}>Japan</option>
    <option value="JOR" {{ isset($client) && $client->country == "JOR" ? "selected" : "" }}>Jordan</option>
    <option value="KAZ" {{ isset($client) && $client->country == "KAZ" ? "selected" : "" }}>Kazakhstan</option>
    <option value="KEN" {{ isset($client) && $client->country == "KEN" ? "selected" : "" }}>Kenya</option>
    <option value="KIR" {{ isset($client) && $client->country == "KIR" ? "selected" : "" }}>Kiribati</option>
    <option value="KWT" {{ isset($client) && $client->country == "KWT" ? "selected" : "" }}>Kuwait</option>
    <option value="KGZ" {{ isset($client) && $client->country == "KGZ" ? "selected" : "" }}>Kyrgyzstan</option>
    <option value="LAO" {{ isset($client) && $client->country == "LAO" ? "selected" : "" }}>Laos</option>
    <option value="LVA" {{ isset($client) && $client->country == "LVA" ? "selected" : "" }}>Latvia</option>
    <option value="LBN" {{ isset($client) && $client->country == "LBN" ? "selected" : "" }}>Lebanon</option>
    <option value="LSO" {{ isset($client) && $client->country == "LSO" ? "selected" : "" }}>Lesotho</option>
    <option value="LBR" {{ isset($client) && $client->country == "LBR" ? "selected" : "" }}>Liberia</option>
    <option value="LBY" {{ isset($client) && $client->country == "LBY" ? "selected" : "" }}>Libya</option>
    <option value="LIE" {{ isset($client) && $client->country == "LIE" ? "selected" : "" }}>Liechtenstein</option>
    <option value="LTU" {{ isset($client) && $client->country == "LTU" ? "selected" : "" }}>Lithuania</option>
    <option value="LUX" {{ isset($client) && $client->country == "LUX" ? "selected" : "" }}>Luxembourg</option>
    <option value="MDG" {{ isset($client) && $client->country == "MDG" ? "selected" : "" }}>Madagascar</option>
    <option value="MWI" {{ isset($client) && $client->country == "MWI" ? "selected" : "" }}>Malawi</option>
    <option value="MYS" {{ isset($client) && $client->country == "MYS" ? "selected" : "" }}>Malaysia</option>
    <option value="MDV" {{ isset($client) && $client->country == "MDV" ? "selected" : "" }}>Maldives</option>
    <option value="MLI" {{ isset($client) && $client->country == "MLI" ? "selected" : "" }}>Mali</option>
    <option value="MLT" {{ isset($client) && $client->country == "MLT" ? "selected" : "" }}>Malta</option>
    <option value="MHL" {{ isset($client) && $client->country == "MHL" ? "selected" : "" }}>Marshall Islands</option>
    <option value="MRT" {{ isset($client) && $client->country == "MRT" ? "selected" : "" }}>Mauritania</option>
    <option value="MUS" {{ isset($client) && $client->country == "MUS" ? "selected" : "" }}>Mauritius</option>
    <option value="MEX" {{ isset($client) && $client->country == "MEX" ? "selected" : "" }}>Mexico</option>
    <option value="FSM" {{ isset($client) && $client->country == "FSM" ? "selected" : "" }}>Micronesia</option>
    <option value="MDA" {{ isset($client) && $client->country == "MDA" ? "selected" : "" }}>Moldova</option>
    <option value="MCO" {{ isset($client) && $client->country == "MCO" ? "selected" : "" }}>Monaco</option>
    <option value="MNG" {{ isset($client) && $client->country == "MNG" ? "selected" : "" }}>Mongolia</option>
    <option value="MNE" {{ isset($client) && $client->country == "MNE" ? "selected" : "" }}>Montenegro</option>
    <option value="MAR" {{ isset($client) && $client->country == "MAR" ? "selected" : "" }}>Morocco</option>
    <option value="MOZ" {{ isset($client) && $client->country == "MOZ" ? "selected" : "" }}>Mozambique</option>
    <option value="MMR" {{ isset($client) && $client->country == "MMR" ? "selected" : "" }}>Myanmar (Burma)</option>
    <option value="NAM" {{ isset($client) && $client->country == "NAM" ? "selected" : "" }}>Namibia</option>
    <option value="NRU" {{ isset($client) && $client->country == "NRU" ? "selected" : "" }}>Nauru</option>
    <option value="NPL" {{ isset($client) && $client->country == "NPL" ? "selected" : "" }}>Nepal</option>
    <option value="NLD" {{ isset($client) && $client->country == "NLD" ? "selected" : "" }}>Netherlands</option>
    <option value="NZL" {{ isset($client) && $client->country == "NZL" ? "selected" : "" }}>New Zealand</option>
    <option value="NIC" {{ isset($client) && $client->country == "NIC" ? "selected" : "" }}>Nicaragua</option>
    <option value="NER" {{ isset($client) && $client->country == "NER" ? "selected" : "" }}>Niger</option>
    <option value="NGA" {{ isset($client) && $client->country == "NGA" ? "selected" : "" }}>Nigeria</option>
    <option value="PRK" {{ isset($client) && $client->country == "PRK" ? "selected" : "" }}>North Korea</option>
    <option value="MKD" {{ isset($client) && $client->country == "MKD" ? "selected" : "" }}>North Macedonia</option>
    <option value="NOR" {{ isset($client) && $client->country == "NOR" ? "selected" : "" }}>Norway</option>
    <option value="OMN" {{ isset($client) && $client->country == "OMN" ? "selected" : "" }}>Oman</option>
    <option value="PAK" {{ isset($client) && $client->country == "PAK" ? "selected" : "" }}>Pakistan</option>
    <option value="PLW" {{ isset($client) && $client->country == "PLW" ? "selected" : "" }}>Palau</option>
    <option value="PSE" {{ isset($client) && $client->country == "PSE" ? "selected" : "" }}>Palestine</option>
    <option value="PAN" {{ isset($client) && $client->country == "PAN" ? "selected" : "" }}>Panama</option>
    <option value="PNG" {{ isset($client) && $client->country == "PNG" ? "selected" : "" }}>Papua New Guinea</option>
    <option value="PRY" {{ isset($client) && $client->country == "PRY" ? "selected" : "" }}>Paraguay</option>
    <option value="PER" {{ isset($client) && $client->country == "PER" ? "selected" : "" }}>Peru</option>
    <option value="PHL" {{ isset($client) && $client->country == "PHL" ? "selected" : "" }}>Philippines</option>
    <option value="POL" {{ isset($client) && $client->country == "POL" ? "selected" : "" }}>Poland</option>
    <option value="PRT" {{ isset($client) && $client->country == "PRT" ? "selected" : "" }}>Portugal</option>
    <option value="QAT" {{ isset($client) && $client->country == "QAT" ? "selected" : "" }}>Qatar</option>
    <option value="ROU" {{ isset($client) && $client->country == "ROU" ? "selected" : "" }}>Romania</option>
    <option value="RUS" {{ isset($client) && $client->country == "RUS" ? "selected" : "" }}>Russia</option>
    <option value="RWA" {{ isset($client) && $client->country == "RWA" ? "selected" : "" }}>Rwanda</option>
    <option value="KNA" {{ isset($client) && $client->country == "KNA" ? "selected" : "" }}>Saint Kitts and Nevis</option>
    <option value="LCA" {{ isset($client) && $client->country == "LCA" ? "selected" : "" }}>Saint Lucia</option>
    <option value="VCT" {{ isset($client) && $client->country == "VCT" ? "selected" : "" }}>Saint Vincent and the Grenadines</option>
    <option value="WSM" {{ isset($client) && $client->country == "WSM" ? "selected" : "" }}>Samoa</option>
    <option value="SMR" {{ isset($client) && $client->country == "SMR" ? "selected" : "" }}>San Marino</option>
    <option value="STP" {{ isset($client) && $client->country == "STP" ? "selected" : "" }}>Sao Tome and Principe</option>
    <option value="SAU" {{ isset($client) && $client->country == "SAU" ? "selected" : "" }}>Saudi Arabia</option>
    <option value="SEN" {{ isset($client) && $client->country == "SEN" ? "selected" : "" }}>Senegal</option>
    <option value="SRB" {{ isset($client) && $client->country == "SRB" ? "selected" : "" }}>Serbia</option>
    <option value="SYC" {{ isset($client) && $client->country == "SYC" ? "selected" : "" }}>Seychelles</option>
    <option value="SLE" {{ isset($client) && $client->country == "SLE" ? "selected" : "" }}>Sierra Leone</option>
    <option value="SGP" {{ isset($client) && $client->country == "SGP" ? "selected" : "" }}>Singapore</option>
    <option value="SVK" {{ isset($client) && $client->country == "SVK" ? "selected" : "" }}>Slovakia</option>
    <option value="SVN" {{ isset($client) && $client->country == "SVN" ? "selected" : "" }}>Slovenia</option>
    <option value="SLB" {{ isset($client) && $client->country == "SLB" ? "selected" : "" }}>Solomon Islands</option>
    <option value="SOM" {{ isset($client) && $client->country == "SOM" ? "selected" : "" }}>Somalia</option>
    <option value="ZAF" {{ isset($client) && $client->country == "ZAF" ? "selected" : "" }}>South Africa</option>
    <option value="KOR" {{ isset($client) && $client->country == "KOR" ? "selected" : "" }}>South Korea</option>
    <option value="SSD" {{ isset($client) && $client->country == "SSD" ? "selected" : "" }}>South Sudan</option>
    <option value="ESP" {{ isset($client) && $client->country == "ESP" ? "selected" : "" }}>Spain</option>
    <option value="LKA" {{ isset($client) && $client->country == "LKA" ? "selected" : "" }}>Sri Lanka</option>
    <option value="SDN" {{ isset($client) && $client->country == "SDN" ? "selected" : "" }}>Sudan</option>
    <option value="SUR" {{ isset($client) && $client->country == "SUR" ? "selected" : "" }}>Suriname</option>
    <option value="SWE" {{ isset($client) && $client->country == "SWE" ? "selected" : "" }}>Sweden</option>
    <option value="CHE" {{ isset($client) && $client->country == "CHE" ? "selected" : "" }}>Switzerland</option>
    <option value="SYR" {{ isset($client) && $client->country == "SYR" ? "selected" : "" }}>Syria</option>
    <option value="TWN" {{ isset($client) && $client->country == "TWN" ? "selected" : "" }}>Taiwan</option>
    <option value="TJK" {{ isset($client) && $client->country == "TJK" ? "selected" : "" }}>Tajikistan</option>
    <option value="TZA" {{ isset($client) && $client->country == "TZA" ? "selected" : "" }}>Tanzania</option>
    <option value="THA" {{ isset($client) && $client->country == "THA" ? "selected" : "" }}>Thailand</option>
    <option value="TLS" {{ isset($client) && $client->country == "TLS" ? "selected" : "" }}>Timor-Leste</option>
    <option value="TGO" {{ isset($client) && $client->country == "TGO" ? "selected" : "" }}>Togo</option>


    
</select>
</div>

<div class="form-group row">
            <div class="col-sm-12">
            <label class="col-form-label fw-bold">Company Address<span class="text-danger"></span></label>
            <textarea class="form-control" name="company_address"cols="6" rows="1"   value="{{isset($client) ? $client->company_address : ''}}" class="form-control" id="company_address" placeholder="Company Address"></textarea>
            </div>
        </div>   
        <hr> 

</div>

<h5 class="text-primary">Bank Details</h5>

<div class="form-group row">
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">Bank Name<span class="text-danger"></span></label>
        <input type="text" name="bank_name"  value="{{isset($client) ? $client->bank_name : ''}}" class="form-control" placeholder="Enter Bank Name">
    </div>
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">Bank Branch Name<span class="text-danger"></span></label>
        <input type="bank_branch_name" name="bank_branch_name"  value="{{isset($client) ? $client->bank_branch_name : ''}}" class="form-control" placeholder="Enter Bank Branch Name ">
    </div>
</div> 

<div class="form-group row">
<div class="col-sm-6 fw-bold">
        <label class="col-form-label">Account NO.<span class="text-danger"></span></label>
        <input type="account_no" name="account_no"  value="{{isset($client) ? $client->account_no : ''}}" class="form-control" placeholder="Enter Account No. ">
    </div>
    <div class="col-sm-6 fw-bold">
        <label class="col-form-label">IFSC NO.<span class="text-danger"></span></label>
        <input type="ifsc_no " name="ifsc_no" value="{{isset($client) ? $client->ifsc_no : ''}}" class="form-control" placeholder="Enter IFSC No.">
    </div>
</div> 

        <div class="form-group icon-input text-center">
            <a href="/" class="btn btn-success">Back</a>
            <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn"> Save </button>
        </div>
</div>
    </form>
   </div> 
  </div>  

</div>

<script>
    // Initialize Select2
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
  </script>
                            
@endsection
