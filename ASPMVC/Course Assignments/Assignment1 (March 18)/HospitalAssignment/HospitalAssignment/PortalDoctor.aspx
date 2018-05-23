<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PortalDoctor.aspx.cs" Inherits="HospitalAssignment.PortalDoctor" %>

<!DOCTYPE html>
<%--Same basic layout as the patient page with a few more added features--%>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Doctor Portal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .background {
            background-image: url("https://img00.deviantart.net/4636/i/2011/306/5/7/futuristic_hospital_room_by_jr1091-d4esuf9.jpg");
            background-size: 100%;
        }

        .time-font {
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>
<body class="background">
    <form id="form1" runat="server">
        <div>
            <div class="container">
                <div class="well">
                    <table class="table">
                        <asp:Button ID="btnBack"  CssClass="btn btn-default"  runat="server" Text="Back" OnClick="btnBack_Click" />

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Specialty</th>
                                <th>Edit information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <asp:Label ID="lblId" runat="server" Text=""></asp:Label></td>
                                <td>
                                    <asp:TextBox ID="txtFirst" runat="server"></asp:TextBox></td>
                                <td>
                                    <asp:TextBox ID="txtLast" runat="server"></asp:TextBox></td>
                                <td>
                                    <asp:TextBox ID="txtSpecialty" runat="server"></asp:TextBox></td>
                                <td>
                                    <asp:Button ID="btnUpdateDoctor" CssClass="btn btn-danger btn-block btn-sm" runat="server" Text="SUBMIT" OnClick="btnUpdateDoctor_Click" /></td>
                            </tr>
                        </tbody>
                    </table>
                    <asp:Label ID="lblRows" runat="server" Text=""></asp:Label>
                </div>

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">DOCTOR HISTORY</div>

                        <div class="panel-body">
                            <asp:Label ID="lblDescription" runat="server" CssClass="text-justify time-font" Text=""></asp:Label>
                        </div>

                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Doctor ID</th>
                                        <th>Date In</th>
                                        <th>Date Out</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <asp:TextBox ID="txtPatientId" runat="server"></asp:TextBox></td>
                                        <td>
                                            <asp:Label ID="lblDocId" runat="server" Text=""></asp:Label></td>
                                        <td>
                                            <asp:TextBox ID="txtDateIn" runat="server" TextMode="Date"></asp:TextBox></td>
                                        <td>
                                            <asp:TextBox ID="txtDateOut" runat="server" TextMode="Date"></asp:TextBox></td>
                                        <td>
                                            <asp:TextBox ID="txtDescription" CssClass="form-control" runat="server" TextMode="MultiLine"></asp:TextBox></td>
                                    </tr>
                                </tbody>
                            </table>
                            <asp:Button ID="btnAddVisit" CssClass="btn btn-default btn-block btn-sm" runat="server" Text="ADD" OnClick="btnAddVisit_Click" />
                            <asp:Label ID="lblRowsInserted" runat="server" Text=""></asp:Label>
                        </div>
                    </div>
                </div>

                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">ASSIGN NEW DOCTOR</div>

                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Patient ID</th>
                                        <th>Doctor ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <asp:TextBox ID="txtPatientIdToChange" runat="server"></asp:TextBox></td>
                                        <td>
                                            <asp:TextBox ID="txtDoctorIdToChange" runat="server"></asp:TextBox></td>
                                    </tr>
                                </tbody>
                            </table>
                            <asp:Button ID="btnUpdateMainDoctor" CssClass="btn btn-default btn-block btn-sm" runat="server" Text="UPDATE" OnClick="btnUpdateMainDoctor_Click" />
                            <asp:Label ID="lblMainDoctorUpdated" runat="server" Text=""></asp:Label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
