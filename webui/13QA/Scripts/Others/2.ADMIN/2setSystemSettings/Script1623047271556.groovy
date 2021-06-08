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

WebUI.navigateToUrl(GlobalVariable.StoreURLDefault+GlobalVariable.AdminURL)

WebUI.setText(findTestObject('Object Repository/Page_Administration/input_Please enter your login details._username'), GlobalVariable.defaultAdminUsername)

WebUI.setEncryptedText(findTestObject('Object Repository/Page_Administration/input_Please enter your login details._password'),
    'PblvLzUlPsM=')

WebUI.click(findTestObject('Object Repository/Page_Administration/button_Login'))

WebUI.click(findTestObject('Object Repository/Page_Dashboard/h5_Settings'))

WebUI.click(findTestObject('Object Repository/Page_Settings/span_System'))

WebUI.click(findTestObject('Object Repository/Page_Settings/button_ON_btn btn-default'))

WebUI.click(findTestObject('Object Repository/Page_Settings/a_OFF_icon_save fa fa-check'))


WebUI.selectOptionByValue(findTestObject('Object Repository/Page_Settings/select_Level 0 - no logs , only exception e_a58d28'),
    '1', true)

WebUI.click(findTestObject('Object Repository/Page_Settings/a_Debug Level_icon_save fa fa-check'))

WebUI.verifyElementPresent(findTestObject('Object Repository/Page_Settings/button_ON'), 0)

WebUI.closeBrowser()
