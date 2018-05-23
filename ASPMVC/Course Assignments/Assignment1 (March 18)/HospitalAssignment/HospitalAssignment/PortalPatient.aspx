<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="PortalPatient.aspx.cs" Inherits="HospitalAssignment.PortalPatient" %>

<!DOCTYPE html>

<%--Basic layout for the portals
    Pretty much every portal follows the same template--%>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Patient Portal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        .background {
            background-image: url("https://cdnb.artstation.com/p/assets/images/images/003/274/757/large/nikolay-razuev-futuristic-hospital-final-s.jpg?1490094245");
            background-size: 100%;
        }

        .time-font {
            font-family: "Times New Roman", Times, serif;
        }
    </style>

</head>
<body class="background">
    <form id="form1" runat="server">

        <div class="container">
            <div class="well">
                <table class="table">
                    <asp:Button ID="btnBack" CssClass="btn btn-default" runat="server" Text="Back" OnClick="btnBack_Click" />

                    <thead>
                        <tr>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">City</th>
                            <th class="text-center">Road</th>
                            <th class="text-center">Birth Year</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <asp:TextBox ID="txtFirst" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:TextBox ID="txtLast" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:TextBox ID="txtCity" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:TextBox ID="txtRoad" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:TextBox ID="txtBirth" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:TextBox ID="txtGender" runat="server"></asp:TextBox></td>
                            <td>
                                <asp:Button ID="btnUpdatePatient" CssClass="btn btn-default btn-sm" runat="server" Text="SUBMIT" OnClick="btnUpdatePatient_Click" /></td>
                        </tr>
                    </tbody>
                </table>

                <asp:RequiredFieldValidator ID="RequiredFieldValidator1" ControlToValidate="txtFirst" runat="server" ErrorMessage="Mus Enter a name" ForeColor="Red"></asp:RequiredFieldValidator>


                <asp:Label ID="lblRows" runat="server" Text=""></asp:Label>
            </div>

            <div class="panel panel-primary">
                <div class="panel-heading text-center">PATIENT HISTORY</div>
                <div class="panel-body">
                    <asp:Label ID="lblDescription" runat="server" CssClass="text-justify time-font" Text=""></asp:Label>
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <p>Pick a date to filter by:</p>
                        <asp:TextBox ID="txtFilterDate" runat="server" TextMode="Date"></asp:TextBox>
                    </div>
                    <br />
                    <asp:Button ID="btnFilterDate" CssClass="btn btn-default btn-block" runat="server" Text="FILTER" OnClick="btnFilterDate_Click" />
                    <asp:Button ID="btnViewAll" CssClass="btn btn-default btn-block" runat="server" Text="VIEW ALL" OnClick="btnViewAll_Click" />
                </div>

            </div>


        </div>
    </form>
</body>
</html>
