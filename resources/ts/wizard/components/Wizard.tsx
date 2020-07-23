import * as React from 'react'
import {FC, useState} from 'react'
import {Settings} from "../../sdk/Settings";
import StepOne from "./StepOne";
import StepTwo from "./StepTwo";
import StepThree from "./StepThree";
import Container from 'react-bootstrap/Container';
import Row from 'react-bootstrap/Row';
import Col from 'react-bootstrap/Col';
import Form from "react-bootstrap/Form";

interface WizardProps {
    settings: Settings
}

export interface WizardData {
    province: string;
    dateStart: string;
    dateStop: string;
    email: string;
    letters: string[];
    uuid: string;
}

const Wizard: FC<WizardProps> = ({settings}: WizardProps) => {
    const [step, setStep] = useState(1)
    const [data, setData] = useState({} as WizardData)

    const handleForward = () => {
        if (step < 3) {
            setStep(step => step + 1)
        }
    }
    const handleBackward = () => {
        if (step > 1) {
            setStep(step => step - 1)
        }
    }

    return (
        <Container>
            <Row>
                <Col>
                    <Form>
                        <StepOne
                            minDate={settings.dateRangeStart}
                            maxDate={settings.dateRangeStop}
                            visible={step === 1}
                            onForward={handleForward}
                            onBackward={handleBackward}
                            data={data}
                            setData={setData}
                        />
                        <StepTwo visible={step === 2} onForward={handleForward} onBackward={handleBackward}/>
                        <StepThree visible={step === 3} onForward={handleForward} onBackward={handleBackward}/>
                    </Form>
                </Col>
            </Row>
        </Container>
    )
}

export default Wizard
