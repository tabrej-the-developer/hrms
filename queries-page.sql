queries 

create table centerRecord (
		id int auto_increment not null primary key,
		centerId varchar(20), 
		centerRecordUniqueId varchar(50) unique, 
		centreABN int(10), 
		centreACN int(10), 
		centreSE_no varchar(10), 
		centreDateOpened timestamp, 
		centreCapacity int(5), 
		centreApprovalDoc varchar(100), 
		centreCCSDoc varchar(100), 
		managerId varchar(20), 
		centreAdminId varchar(20), 
		centreNominatedSupervisorId varchar(20)
		);

create table centerComplianceInformation(
		id int auto_increment not null primary key,
		centerId varchar(20),
		uniqueId varchar(20),
		complianceName varchar(30),
		complianceDesc varchar(30),
		complianceContactName varchar(30),
		complianceContactNumber varchar(15),
		complianceContactEmail varchar(30),
		complianceExpiryRenewalDate	timestamp,
		complianceDocument varchar(100)
		);

create table centreSupplierInfo(
		id int auto_increment not null primary key,
		centerId varchar(20),
		supplierName varchar(30),
		supplierDesc varchar(30),
		supplierAccountNo varchar(15),
		supplierContactName	varchar(30),
		supplierContactNumber varchar(15),
		supplierContactEmail varchar(15)
		);

create table HR_record(
		id int auto_increment not null primary key,
		employeeNo varchar(8), -- Auto assign pattern Ennnnnnn 
		uniqueId varchar(20),
		currentlyEmployed varchar(1), -- Values ‘Y’ or ‘N’
		commencementDate timestamp,
		contractPosition varchar(30),
		resumeSupplied varchar(1),  -- Values ‘Y’ or ‘N’
		resumeDoc varchar(100),
		employmentType varchar(10),  -- Values ‘FT’ ‘PT’ ‘Casual’
		currentContractNotes varchar(35),
		currentContractSignatureDate timestamp,
		currentContractCommencementDate timestamp,
		currentContractEndDate timestamp,
		currentContractPaidStartDate timestamp,
		probationEndDate timestamp,	
		industryYearsExpAsNov19 int(2),
		prohibitionNoticeDeclaration timestamp,
		VITcardNo int(10),
		VITexpiry timestamp,
		WWCCcardNo varchar(15),
		WWCCexpiry timestamp,
		foodHandlingSafety timestamp,
	    lastPoliceCheck timestamp,
	    childProtectionCheck timestamp,
	    nominatedSupervisor varchar(5),-- Values ‘Y’ or ‘N’
		workcover varchar(15),
		PIAWE int(10) COMMENT 'Pre Injury Average Weekly Earnings',
		annualLeaveInContract varchar(15), 
		otherQualifications text COMMENT JSON,  -- Occurs x times for each qualification JSON
		otherQualDesc varchar(20),
		highestQualHeld	varchar(30),
		highestQualType varchar(30),
		qualTowardsDesc varchar(30),
		qualTowards%comp int(2),
		contractAwardId varchar(20),
		-- 10 Award-desc          Obtained for awards database
		-- 10 Award-level		Obtained for awards database
		-- 10 Annual-salary-rate  Obtained for awards database
		-- 10 Hourly-rate-plus-super Obtained for awards database
		paidAwardId varchar(20),
		-- 10 Paid-award		Obtained for awards database
		-- 10 Paid-level 		Obtained for awards database
		-- 10 Paid-annual-salary-rate  Obtained for awards database
		-- 10 Paid-hourly-rate	Obtained for awards database
		visaType varchar (20),
		visaGrantDate timestamp,
		visaEndDate	timestamp,
		visaConditions varchar(30)
		);

create table medicalInfo(
		id int auto_increment not null primary key,
		employeeNo varchar(8),
		medicareNo int(10),
		medicareRefNo int(1),
		healthInsuranceFund varchar(30),
		healthInsuranceNo varchar(15),	
		ambulanceSubscriptionNo varchar(15),
		medicalConditions varchar(20) COMMENT 'JSON', -- x times per entry  JSON
		medicalAllergies varchar(20) COMMENT 'JSON', --  x times per entry JSON
		medication varchar(20) COMMENT 'JSON',  -- x times per entry JSON
		dietaryPreferences varchar(30) COMMENT 'JSON',  -- x times per entry JSON
	    anaphylaxis timestamp,  	
	    asthma timestamp,
		maternityStartDate 	timestamp,
		maternityEndDate timestamp
		);


	Employee-no 
	Currently-employed
	Commencement-date

	05 Payroll-entity
		-- // 10 Entity-name         Dropdown from Centre-database
		-- // 10 Entity-ABN          Derived from Entity name
		-- // 10 Entity-CAN          Derived from Entity name 
	Contract-position	
	Resume-details.
	Resume-supplied
	Resume-doc   
	Employment-type
	Current-contract-notes
	Current-contract-signature-date 	
	Current-contract-commencement-date 
	Current-contract-end-date	
	Current-contract-paid-start-date 
	Probation-end-date 	
	Industry-years-exp-as-nov19	


	Other-qualifications.  Occurs x times for each qualification JSON
		Other-Qual-desc	
		Highest-qual-held
		Highest-qual-type	 
		Qual-towards-desc
		Qual-towards-%-comp
	Contract-award.
		Award-desc          Obtained for awards database
		Award-level		Obtained for awards database
		Annual-salary-rate  Obtained for awards database
		Hourly-rate-plus-super Obtained for awards database
	Paid-award.
		Paid-award		Obtained for awards database
		Paid-level 		Obtained for awards database
		Paid-annual-salary-rate  Obtained for awards database
		Paid-hourly-rate	Obtained for awards database
	
	First-aid-expiry
	CPR-expiry
	Prohibition-Notice-Declaration
	VIT-card-no
	VIT-expiry
	WWCC-card-no	
	WWCC-expiry
	Food-handling-safety
	Last-police-check
	Child-protection-check
	Nominated-supervisor

	Visa-type		
	Visa-grant-date	
	Visa-end-date	
	Visa-conditions	
	Workcover
	PIAWE
	Annual-leave-in-contract



	Anaphylaxis        		Date.  	
	Asthma			Date.
	05 Maternity-information.
		Maternity-start-date 	Date. JSON
		Maternity-end-date 		Date. JSON


	Montessori-details. 		
		Montessori-trained-lvl		
		Room-min-age        
		Room-max-age        
            Room-capacity 


employeeNo	uniqueId	currentlyEmployed	commencementDate	contractPosition	resumeSupplied	resumeDoc	employmentType	currentContractNotes	currentContractSignatureDate	currentContractCommencementDate	currentContractEndDate	currentContractPaidStartDate	probationEndDate	industryYearsExpAsNov19	prohibitionNoticeDeclaration	VITcardNo	VITexpiry	WWCCcardNo	WWCCexpiry	foodHandlingSafety	lastPoliceCheck	childProtectionCheck	nominatedSupervisor	workcover	PIAWE annualLeaveInContract	otherQualifications	otherQualDesc	highestQualHeld	highestQualType	qualTowardsDesc	qualTowardsPercentcomp	contractAwardId	paidAwardId	visaType	visaGrantDate	visaEndDate	visaConditions
