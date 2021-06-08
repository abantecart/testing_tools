import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testng.keyword.TestNGBuiltinKeywords as TestNGKW
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable
import org.openqa.selenium.Keys as Keys

WebUI.openBrowser('')

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault)

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Please review below license agreement_agree'))

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/a_Continue'))

WebUI.verifyElementText(findTestObject('Object Repository/Page_AbanteCart - Installation/span_Writable'), 'Writable')

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/a_Continue_1'))

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Database Username_db_user'), GlobalVariable.DBuser)

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Database Password_db_password'), GlobalVariable.DBpassword)

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Database Name_db_name'))

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Database Name_db_name'), GlobalVariable.DbName)

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Table Names Prefix_db_prefix'), 'sl_')

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Admin section unique key_admin_path'),
    GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Admin Password_password'),
    'PblvLzUlPsM=')

WebUI.setEncryptedText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Confirm Password_password_confirm'),
    'PblvLzUlPsM=')

WebUI.setText(findTestObject('Object Repository/Page_AbanteCart - Installation/input_Admin Email_email'), 'test@abantecart.com')

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/a_Continue'))

WebUI.verifyElementText(findTestObject('Object Repository/Page_AbanteCart - Installation/p_Your comments and contributions are very welcome'),
    'Your comments and contributions are very welcome.')

WebUI.verifyElementPresent(findTestObject('Object Repository/Page_AbanteCart - Installation/a'), 0)

WebUI.click(findTestObject('Object Repository/Page_AbanteCart - Installation/img'))

WebUI.verifyElementPresent(findTestObject('Object Repository/Page_Administration/small_Please enter your login details'),
    0)

WebUI.closeBrowser()
