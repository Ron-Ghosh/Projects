-- Final Project Insert

CREATE TABLE [dbo].[Books] (
    [Id]     INT          IDENTITY (1, 1) NOT NULL,
    [Name]   VARCHAR (50) NULL,
    [Author] VARCHAR (50) NULL,
    [Copies] INT          DEFAULT ((10)) NOT NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC)
);

CREATE TABLE [dbo].[Users] (
    [Id]         INT          IDENTITY (1, 1) NOT NULL,
    [First_Name] VARCHAR (50) NULL,
    [Last_Name]  VARCHAR (50) NULL,
    [Email]      VARCHAR (50) NULL,
    [Pass_Hash]  VARCHAR (50) NULL,
    [Privilege]  VARCHAR (50) NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC)
);

CREATE TABLE [dbo].[Rentals] (
    [Id]            INT  IDENTITY (1, 1) NOT NULL,
    [Book_Id]       INT  NULL,
    [User_Id]       INT  NULL,
    [Sign_Out_Date] DATE NULL,
    [Return_Date]   DATE NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC),
    FOREIGN KEY ([Book_Id]) REFERENCES [dbo].[Books] ([Id]),
    FOREIGN KEY ([User_Id]) REFERENCES [dbo].[Users] ([Id])
);

CREATE TABLE [dbo].[Reviews] (
    [Id]      INT          IDENTITY (1, 1) NOT NULL,
    [Book_Id] INT          NULL,
    [User_Id] INT          NULL,
    [Review]  VARCHAR (50) NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC),
    FOREIGN KEY ([Book_Id]) REFERENCES [dbo].[Books] ([Id]),
    FOREIGN KEY ([User_Id]) REFERENCES [dbo].[Users] ([Id])
);

CREATE TABLE [dbo].[Wishlists] (
    [Id]      INT IDENTITY (1, 1) NOT NULL,
    [Book_Id] INT NULL,
    [User_Id] INT NULL,
    PRIMARY KEY CLUSTERED ([Id] ASC),
    FOREIGN KEY ([Book_Id]) REFERENCES [dbo].[Books] ([Id]),
    FOREIGN KEY ([User_Id]) REFERENCES [dbo].[Users] ([Id])
);